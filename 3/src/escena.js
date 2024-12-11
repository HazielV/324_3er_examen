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

// Crear un grupo para las esferas
const points = new THREE.Group()

// Crear 10 esferas y agregarlas al grupo
for (let i = 0; i < 10; i++) {
  const geometry = new THREE.SphereGeometry(0.1, 16, 16)
  const material = new THREE.MeshBasicMaterial({
    color: Math.random() * 0xffffff,
  }) // Color aleatorio
  const sphere = new THREE.Mesh(geometry, material)

  sphere.position.set(
    (Math.random() - 0.5) * 10, // Posición aleatoria en X
    (Math.random() - 0.5) * 10, // Posición aleatoria en Y
    (Math.random() - 0.5) * 10 // Posición aleatoria en Z
  )

  points.add(sphere) // Añadir la esfera al grupo
}

// Añadir el grupo de esferas a la escena
scene.add(points)

// Posicionar la cámara para ver las esferas
camera.position.z = 5

// Función de animación
function animate() {
  requestAnimationFrame(animate)
  renderer.render(scene, camera)
}

animate()
