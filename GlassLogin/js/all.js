const btn = document.querySelector('button')

btn.addEventListener('mouseenter', () => {
    btn.classList.add('entrar')
    btn.classList.remove('entrar-reverse')
})

btn.addEventListener('mouseleave', () => {
    btn.classList.add('entrar-reverse')
    btn.classList.remove('entrar')
})