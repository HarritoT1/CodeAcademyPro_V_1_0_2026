function create () {
    const contenedor = document.getElementById("burbujas-container");
    const burbuja = document.createElement("div");
    burbuja.classList.add("burbuja");
    burbuja.style.left = `${Math.random() * 100}%`;
    
    const size = Math.random() * 15 + 10;
    burbuja.style.width = `${size}px`;
    burbuja.style.height = `${size}px`;

    burbuja.style.animationName = "moverArriba";
    burbuja.style.animationDuration = `${Math.random() * 3 + 2}s`;
    
    contenedor.appendChild(burbuja);

    burbuja.addEventListener("animationend", () => {
        burbuja.remove()
    })
}

document.addEventListener("DOMContentLoaded", () => {
    setInterval(create, 300);
});

