from deepface import DeepFace
import mediapipe as mp
from mtcnn import MTCNN
import numpy as np
import cv2
import os
import pickle

mp_face_detection = mp.solutions.face_detection
mp_drawing = mp.solutions.drawing_utils
# define model
model = DeepFace.build_model("VGG-Face")

# define function to preprocess images
face_detection = mp_face_detection.FaceDetection(
    model_selection=1, min_detection_confidence=0.5)

def preprocess_image(image):
    image = cv2.resize(image,(224,224))
    image = np.expand_dims(image, axis=0)
    image = image.astype('float32')
    image = (image - image.mean()) / image.std()
    return image


def detect_faces(image):
  results = face_detection.process(cv2.cvtColor(image, cv2.COLOR_BGR2RGB))

    # Draw face detections of each face.
  if not results.detections:
    return
  annotated_image = image.copy()
  for detection in results.detections:
    if detection.score[0] > 0.5:
      bbox = detection.location_data.relative_bounding_box
      h, w, c = image.shape
      x, y, width, height = int(bbox.xmin * w), int(bbox.ymin * h), int(bbox.width * w), int(bbox.height * h)
    if x<0:
      x = 0
    if y<0:
      y = 1
    if height>annotated_image.shape[0]:
      height = annotated_image.shape[0]
    if width > annotated_image.shape[1]:
      width = annotated_image.shape[1]
  return annotated_image[y:y+height, x:x+width]
  

  
# define function to extract face embeddings
def get_embedding(model, face):
    face = preprocess_image(face)
    embedding = model.predict(face)
    return embedding[0]

# define function to load face images and extract embeddings
def load_embeddings(directory):
    embeddings = []
    labels = []
    for image_filename in os.listdir(directory):
    # Load the image
        image_path = os.path.join(directory, image_filename)
        image = cv2.imread(image_path)
        image = detect_faces(image)
        embedding = get_embedding(model, image)
        embeddings.append(embedding)
        labels.append(int(image_filename.split("_")[-1].split(".")[0]))
    return embeddings, labels

new_faces_path = r'final_train'

# load face embeddings and labels
embeddings, labels = load_embeddings(new_faces_path)
new_labels = set(labels)


# Specify the file path
database_path = r'face_database.pkl'
label_database_path = r'face_name_database.pkl'

faces_list = []
faces_name_list = []

# Check if the file exists
if os.path.exists(database_path):
    faces_list = pickle.load(
    open('face_database.pkl', 'rb'))
    faces_list = list(faces_list)

if os.path.exists(database_path):
    faces_name_list = pickle.load(
    open('face_name_database.pkl', 'rb'))
    faces_name_list = list(faces_name_list)

new_names = []
for x in new_labels:
   if x not in faces_name_list:
      new_names.append(x)

for i in range(len(embeddings)):
   if labels[i] in new_names:
      faces_list.append(embeddings[i])
      faces_name_list.append(labels[i])

print(set(faces_name_list))
print(len(faces_list))
pickle.dump(faces_list,open(r'face_database.pkl','wb'))
pickle.dump(faces_name_list,open(r'face_name_database.pkl','wb'))