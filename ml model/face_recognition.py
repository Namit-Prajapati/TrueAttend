from flask import Flask, request, jsonify
import cv2
from deepface import DeepFace
import mediapipe as mp
from mtcnn import MTCNN
import numpy as np
import cv2
import os
import pickle
import time
import json

app = Flask(__name__)

mp_face_detection = mp.solutions.face_detection
mp_drawing = mp.solutions.drawing_utils

face_detection = mp_face_detection.FaceDetection(
    model_selection=1, min_detection_confidence=0.5)

model = DeepFace.build_model("VGG-Face")


def preprocess_image(image):
    image = cv2.resize(image, (224, 224))
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
            x, y, width, height = int(
                bbox.xmin * w), int(bbox.ymin * h), int(bbox.width * w), int(bbox.height * h)
        if x < 0:
            x = 0
        if y < 0:
            y = 1
        if height > annotated_image.shape[0]:
            height = annotated_image.shape[0]
        if width > annotated_image.shape[1]:
            width = annotated_image.shape[1]
    return annotated_image[y:y+height, x:x+width]


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
        return labels[min_idx]


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


# Specify the file path
database_path = r'face_database.pkl'
label_database_path = r'face_name_database.pkl'

faces_list = []
faces_name_list = []

# Check if the file exists
if os.path.exists(database_path):
    faces_list = pickle.load(
        open(database_path, 'rb'))
    faces_list = list(faces_list)

if os.path.exists(database_path):
    faces_name_list = pickle.load(
        open(label_database_path, 'rb'))
    faces_name_list = list(faces_name_list)


@app.route('/train')
def train():
    new_faces_path = r'C:\xampp\htdocs\TrueAttend\ml model\final_train'
# load face embeddings and labels
    embeddings, labels = load_embeddings(new_faces_path)
    new_labels = set(labels)
    new_names = []
    for x in new_labels:
        if x not in faces_name_list:
            new_names.append(x)

    for i in range(len(embeddings)):
        if labels[i] in new_names:
            faces_list.append(embeddings[i])
            faces_name_list.append(labels[i])
    no_of_person = list(set(faces_name_list))
    Total_faces = len(faces_list)
    res_dict = {"Trained Student": no_of_person, "Total faces": Total_faces}
    pickle.dump(faces_list, open(r'face_database.pkl', 'wb'))
    pickle.dump(faces_name_list, open(r'face_name_database.pkl', 'wb'))
    return jsonify(res_dict)


@app.route('/recognize')
def recognize():
    enroll = list(set(faces_name_list))
    cap = cv2.VideoCapture(0)
    ret,frame = cap.read()
    results = face_detection.process(
        cv2.cvtColor(frame, cv2.COLOR_BGR2RGB))
    each_iter_attendence = []
    annotated_image = frame.copy()
    for detection in results.detections:
        if detection.score[0] > 0.5:
            bbox = detection.location_data.relative_bounding_box
            h, w, c = frame.shape
            x, y, width, height = int(
                bbox.xmin * w), int(bbox.ymin * h), int(bbox.width * w), int(bbox.height * h)
            if x < 0:
                x = 0
            if y < 0:
                y = 1
            if height > annotated_image.shape[0]:
                height = annotated_image.shape[0]
            if width > annotated_image.shape[1]:
                width = annotated_image.shape[1]
            label = recognize_face(
                model, faces_list, faces_name_list, frame[y:y+height, x:x+width])
            each_iter_attendence.append(label)
            # if min_dist < 0.4:
            #     cv2.rectangle(
            #         frame, (x, y), (x+width, y+height), (0, 255, 0), 2)
            #     cv2.putText(frame, dictn[label], (x, y-10),
            #                 cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 255, 0), 2)
            #     each_iter_attendence.append(label)
            # else:
            #     cv2.rectangle(
            #         frame, (x, y), (x+width, y+height), (0, 255, 0), 2)
            #     cv2.putText(frame, "Not Recognize"+str(min_dist), (x, y-10),
            #                 cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 255, 0), 2)
    cap.release()
    return jsonify(each_iter_attendence)


if __name__ == '__main__':
    app.run(debug=True)
