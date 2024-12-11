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
  })
  const sphere = new THREE.Mesh(geometry, material)

  sphere.position.set(
    (Math.random() - 0.5) * 10,
    (Math.random() - 0.5) * 10,
    (Math.random() - 0.5) * 10
  )

  points.add(sphere)
}

scene.add(points)

// Mover la cámara de forma lenta
camera.position.z = 5

// Función de animación
function animate() {
  requestAnimationFrame(animate)

  // Rotar el grupo de esferas para verlas desde diferentes ángulos
  points.rotation.y += 0.001 // Rotación suave

  renderer.render(scene, camera)
}

animate()
