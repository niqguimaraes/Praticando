function addZero(time) {
   if (time < 10) {
      time = '0' + time
   }
   return time;
}

//Criando a classe para o Relógio
class Clock {
   //Relógio
   displayClockTime() {
      let date = new Date()
      let hour = addZero(date.getHours())
      let minute = addZero(date.getMinutes())
      let second = addZero(date.getSeconds())
      document.getElementById('clock-hour').textContent = hour
      document.getElementById('clock-minute').textContent = minute
      document.getElementById('clock-second').textContent = second
   }
}

//Declarando os campos
let campoMiliSec = document.getElementById('milisecond')
let campoSec = document.getElementById('second')
let campoMin = document.getElementById('minute')
let campoHour = document.getElementById('hour')
let buttonStart = document.getElementById('start')
let buttonStop = document.getElementById('stop')
let buttonPause = document.getElementById('pause')

let reset = true
let stopWatch

buttonStop.disabled = true
buttonPause.disabled = true

//Criando a classe para o Cronômetro
class StopWatch {
   //Start
   startCron() {
      //Pegando os valores dos campos
      let miliSec = campoMiliSec.textContent
      let second = campoSec.textContent
      let minute = campoMin.textContent
      let hour = campoHour.textContent

      if (reset == false) {
         if (miliSec < 99) {
            campoMiliSec.textContent = addZero(parseInt(miliSec) + 1)
         } else {
            campoMiliSec.textContent = '00'
            if (second < 59) {
               campoSec.textContent = addZero(parseInt(second) + 1)
            } else {
               campoSec.textContent = '00'
               if (minute < 59) {
                  campoMin.textContent = addZero(parseInt(minute) + 1)
               } else {
                  campoMin.textContent = '00'
                  if (hour < 59) {
                     campoHour.textContent = addZero(parseInt(hour) + 1)
                  } else {
                     campoHour.textContent = '00'
                     campoMin.textContent = '00'
                     campoSec.textContent = '00'
                     campoMiliSec.textContent = '00'
                  }
               }
            }
         }
      } else {
         return
      }

   }

   //Stop|Reset
   stopCron() {
      campoMiliSec.textContent = '00'
      campoSec.textContent = '00'
      campoMin.textContent = '00'
      campoHour.textContent = '00'
   }

}

//Criando a classe para o calendário
class Calendar {
   actualDate() {
      const month = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
      let date = new Date()
      let actualDay = addZero(date.getDate())
      //Acrescentando o 0 nos dias com 1 digito
      let actualMonth = month[date.getMonth()]
      let actualYear = date.getFullYear()
      let actualDate = `${actualDay} de ${actualMonth} de ${actualYear}`
      document.getElementById('date').innerHTML = actualDate
   }
}

//Instanciando as classes
const clock = new Clock()
const calendar = new Calendar()
const cron = new StopWatch()

//Colocando o calendário na tela
calendar.actualDate()

//Startando o relógio
clock.displayClockTime()
setInterval(clock.displayClockTime, 1000);

//Startando o cronometro
buttonStart.addEventListener('click', function () {
   reset = false
   clearInterval(stopWatch);
   stopWatch = setInterval(cron.startCron, 10)
   cron.startCron()
   buttonStart.disabled = true
   buttonStop.disabled = false
   buttonPause.disabled = false
})

//Stopando o cronometro
buttonStop.addEventListener('click', function () {
   reset = true
   cron.stopCron()
   buttonStart.disabled = false
   buttonStop.disabled = true
   buttonPause.disabled = true
})

//Pausando o cronometro
buttonPause.addEventListener('click', function () {
   reset = true
   buttonStart.disabled = false
   buttonStop.disabled = false
   buttonPause.disabled = true
})