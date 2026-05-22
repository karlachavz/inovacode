const video = document.getElementById("video");

async function iniciarCamara() {
  await faceapi.nets.ssdMobilenetv1.loadFromUri("../models");
  await faceapi.nets.faceLandmark68Net.loadFromUri("../models");
  await faceapi.nets.faceRecognitionNet.loadFromUri("../models");

  navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => video.srcObject = stream)
    .catch(() => alert("No se pudo acceder a la cámara"));
}

async function loginFacial() {
  const detection = await faceapi
    .detectSingleFace(video)
    .withFaceLandmarks()
    .withFaceDescriptor();

  if (!detection) {
    alert("No se detectó rostro");
    return;
  }

  const res = await fetch("../php/login/login-facial-admin.php", {
    method: "POST",
    body: JSON.stringify(detection.descriptor)
  });

  const data = await res.json();

  if (data.acceso) {
    window.location.href = "menu-administrador.php";
  } else {
    alert("Rostro no reconocido");
  }
}
