var largura = window.innerWidth
var altura = window.innerHeight
var vida = 1
var tempo = 50


var nivel = window.location.search
nivel = nivel.replace('?','')

var posicaoMosquito = 1500
if(nivel === 'normal'){
	posicaoMosquito = 1500
} else if (nivel === 'hard'){
	posicaoMosquito = 1000
} else if (nivel === 'hardest'){
	posicaoMosquito = 750
}
	
console.log(posicaoMosquito)


function ajustaTamanhoPalcoJogo(){
	altura = window.innerHeight
	largura = window.innerWidth
}

var cronometro = setInterval(function(){
	tempo --
	if (tempo == 0) {
		clearInterval(cronometro) // Limpa o intervalo de tempo da variável cronometro
		clearInterval(criaMosquito) //Limpa a variavel na função para parar de criar os mosquitos
		window.location.href = 'vitoria.html'
	} else {
		document.getElementById('cronometro').innerHTML = tempo
	}
}, 1000)

function posicaoRandomica(){

	var posicaoX = Math.floor(Math.random() * largura) - 90 //floor é para arredondar para baixo os números
	var posicaoY = Math.floor(Math.random() * altura) - 90 // -110 só para manter a imagem dentro do quadro

	// Operador ternário
	posicaoX = posicaoX <= 0 ? 0 : posicaoX // Se a posicaoX for menor ou igual a 0, então ela recebe 0, senão ela recebe ela mesma
	posicaoY = posicaoY <= 0 ? 0 : posicaoY

	//Verificar se o elemento já está criado e retirar (caso exista)
	if (document.getElementById('mosquito')) { //Testa para ver se o elemento existe
		if(vida > 3){
			window.location.href = 'gameover.html'
		} else {
			document.getElementById('mosquito').remove()
			document.getElementById('vida'+vida).src = 'imagens/coracao_vazio.png'		
			vida++
		}
	}

	var mosquito = document.createElement('img') //Criando um elemento HTML no javascript
	mosquito.src = 'imagens/mosca.png'
	mosquito.className = tamanhoAleatorio() + ' ' + ladoAleatorio() //Classe do tamanho do mosquito + a classe de lado que o mosquito está virado
	mosquito.style.left = posicaoX + 'px'
	mosquito.style.top = posicaoY + 'px'
	mosquito.style.position = 'absolute'
	mosquito.id = 'mosquito'
	mosquito.onclick = function(){
		this.remove()
	}

	document.body.appendChild(mosquito)

	tamanhoAleatorio()
}

function tamanhoAleatorio(){
	var classe = Math.floor(Math.random() * 3) // Colocando um tamanho aleatório para os mosquitos

	switch(classe) { //Retonando a classe aleatoria
		case 0:
			return 'mosquito1' // não precisa do break porque já tem o return, faz o sistema parar no return
		case 1:
			return 'mosquito2'
		case 2:
			return 'mosquito3'
	}
}

function ladoAleatorio(){
	var classe = Math.floor(Math.random() * 2)

	switch(classe) { 
		case 0:
			return 'ladoB' 
	}
}
