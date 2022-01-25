let botao = document.querySelectorAll('button')
let valor = ''
let operacao = ''

for (let i = 0; i < botao.length; i++) {
   botao[i].addEventListener('mousedown', () => {
      botao[i].style.backgroundColor = 'rgba(223, 223, 223, 0.459)'
      valor = botao[i].value
      let historico = document.getElementById('historico')
      let resultado = document.getElementById('resultado')

      //-- Verifica se o botão apertado não é repetido em caso de operações
      verificaOperacao()

      //------- SWITCH OPERAÇÕES ---------
      switch (valor) {
         case 'zera':
            historico.innerHTML = ''
            resultado.innerHTML = '0'
            operacao = ''
            valor = ''
            break
         case '*':
            historico.innerHTML += 'x'
            operacao += valor
            break
         case '%':
            valor = '/100'
            operacao += valor
            let operacaoPorcentagem = eval(operacao)
            resultado.innerHTML = operacaoPorcentagem
            historico.innerHTML = operacaoPorcentagem
            valor = operacaoPorcentagem
            operacao = operacaoPorcentagem
            break
         case '=':
            historico.innerHTML += valor
            let operacaoFinal = eval(operacao.toString())
            resultado.innerHTML = operacaoFinal
            historico.innerHTML = operacaoFinal
            valor = operacaoFinal
            operacao = operacaoFinal
            break
         case 'deleta':
            if (operacao.length > 0) {
               historico.innerHTML = operacao.substring(0, operacao.length - 1);
               operacao = operacao.substring(0, operacao.length - 1);
            }
            break
         default:
            historico.innerHTML += valor
            operacao += valor
      }
      //------- SWITCH OPERAÇÕES ---------

      console.log(operacao)
   })

   botao[i].addEventListener('mouseup', function () {
      setTimeout(() => {
         botao[i].style.backgroundColor = ''
      }, 100);
   })

}

//-- Verifica se o botão apertado não é repetido em caso de operações
function verificaOperacao() {
   if (operacao.length > 1) {
      let penultima = operacao.slice(-1)
      let ultima = valor.slice(-1)
      console.log(penultima + ':' + ultima)

      if (isNaN(ultima) && penultima === ultima) {
         switch (penultima) {
            case '*':
            case '-':
            case '/':
            case '+':
               valor = ''
            default:
               operacao += valor
         }
      }
   }
}