from deepface import DeepFace
import mediapipe as mp
from mtcnn import MTCNN
import numpy as np
import cv2
import os
import pickle
import time

mp_face_detection = mp.solutions.face_detection
mp_drawing = mp.solutions.drawing_utils

face_detection = mp_face_detection.FaceDetection(
    model_selection=1, min_detection_confidence=0.5)

model = DeepFace.build_model("VGG-Face")


def preprocess_image(image):
    image = cv2.resize(image,(224,224))
    image = np.expand_dims(image, axis=0)
    image = image.astype('float32')
    image = (image - image.mean()) / image.std()
    return image

def get_embedding(model, face):
    face = preprocess_image(face)
    embedding = model.predict(face)
    return embedding[0]

def recognize_face(model, embeddings, labels, face):
    face_embedding = get_embedding(model, face)
    min_dist = 1
    min_idx = -1
    for idx, embedding in enumerate(embeddings):
        a = np.matmul(np.transpose(embedding), face_embedding)
        b = np.sum(np.multiply(embedding, embedding))
        c = np.sum(np.multiply(face_embedding, face_embedding))
        dist = 1 - (a / (np.sqrt(b) * np.sqrt(c)))
        if dist < min_dist:
            min_dist = dist
            min_idx = idx
    if min_idx == -1:
        return None
    else:
        return min_dist,labels[min_idx]


# Specify the file path
database_path = r'face_database.pkl'
label_database_path = r'face_name_database.pkl'


# Check if the file exists
if os.path.exists(database_path):
    faces_list = pickle.load(
    open('face_database.pkl', 'rb'))
    faces_list = list(faces_list)

if os.path.exists(database_path):
    faces_name_list = pickle.load(
    open('face_name_database.pkl', 'rb'))
    faces_name_list = list(faces_name_list)



def attendence():
    cap = cv2.VideoCapture(0)
    dictn = {147: "murtaza",32:"moiz",150:"namit",162:"palash",158:"nirnay",4:"chetan"}
    enroll = [4,32,150,158,162,147]
    stu_attendence = []
    final_attendence_list = []
    for i in range(3):
        ret, frame = cap.read()
        # frame = cv2.imread(r"C:\Users\moizb\Downloads\collage_test.jpg")
        # frame = cv2.resize(frame, (0, 0), fx=0.25, fy=0.25)
        results = face_detection.process(cv2.cvtColor(frame, cv2.COLOR_BGR2RGB))
        each_iter_attendence = []
        annotated_image = frame.copy()
        for detection in results.detections:
            if detection.score[0] > 0.5:
                bbox = detection.location_data.relative_bounding_box
                h, w, c = frame.shape
                x, y, width, height = int(bbox.xmin * w), int(bbox.ymin * h), int(bbox.width * w), int(bbox.height * h)
                cv2.rectangle(annotated_image, (x, y), (x + width, y + height), (0, 255, 0), 2)
                if x<0:
                    x = 0
                if y<0:
                    y = 1
                if height>annotated_image.shape[0]:
                    height = annotated_image.shape[0]
                if width > annotated_image.shape[1]:
                    width = annotated_image.shape[1]
                min_dist,label = recognize_face(model,faces_list,faces_name_list,frame[y:y+height, x:x+width])
                if min_dist<0.4:
                    cv2.rectangle(frame, (x, y), (x+width, y+height), (0, 255, 0), 2)
                    cv2.putText(frame, dictn[label], (x, y-10),
                            cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 255, 0), 2)
                    each_iter_attendence.append(label)
                else:
                    cv2.rectangle(frame, (x, y), (x+width, y+height), (0, 255, 0), 2)
                    cv2.putText(frame, "Not Recognize"+str(min_dist), (x, y-10),
                            cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 255, 0), 2)
        stu_attendence.append(each_iter_attendence)
        cv2.imshow("Frame", frame)
        
        time.sleep(10)

        cv2.destroyAllWindows()
    for x in enroll:
        count = 0
        if x in stu_attendence[0]:
            count = count +1
        if x in stu_attendence[1]:
            count = count + 1
        if x in stu_attendence[2]:
            count = count + 1
        if count>=2:
            final_attendence_list.append(x)
    
    cap.release()
    for x in final_attendence_list:
        print(dictn[x])

attendence()
