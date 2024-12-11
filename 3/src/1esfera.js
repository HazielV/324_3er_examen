import * as THREE from 'three'

// Crear la escena
const scene = new THREE.Scene()

// Crear la cámara (perspectiva)
const camera = new THREE.PerspectiveCamera(
  75,
  window.innerWidth / window.innerHeight,
  0.1,
  1000
)

// Crear el renderizador
const renderer = new THREE.WebGLRenderer()
renderer.setSize(window.innerWidth, window.innerHeight)
document.body.appendChild(renderer.domElement)

// Crear una esfera
const geometry = new THREE.SphereGeometry(0.1, 16, 16)
const material = new THREE.MeshBasicMaterial({ color: 0xff0000 }) // Rojo
const sphere = new THREE.Mesh(geometry, material)

// Colocar la esfera en la escena
scene.add(sphere)

// Posicionar la cámara para que podamos ver la esfera
camera.position.z = 5

// Función de animación
function animate() {
  requestAnimationFrame(animate)
  renderer.render(scene, camera)
}

animate()
