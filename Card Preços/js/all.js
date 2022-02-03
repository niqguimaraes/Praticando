// Dados dos componentes
const pricingData = [{
        title: 'Básico',
        month: 'R$ ' + 19 + ',' + 99,
        year: 'R$ ' + 199 + ',' + 99,
        storage: 500 + ' GB de espaço',
        users: 2 + ' usuários permitidos',
        transfer: 3,
        btn: 'SAIBA MAIS'
    },
    {
        title: 'Profissional',
        month: 'R$ ' + 24 + ',' + 99,
        year: 'R$ ' + 249 + ',' + 99,
        storage: 1 + ' TB de espaço',
        users: 5 + ' usuários permitidos',
        transfer: 10,
        btn: 'SAIBA MAIS'
    },
    {
        title: 'Master',
        month: 'R$ ' + 39 + ',' + 99,
        year: 'R$ ' + 399 + ',' + 99,
        storage: 2 + ' TB de espaço',
        users: 10 + ' usuários permitidos',
        transfer: 20,
        btn: 'SAIBA MAIS'
    },
]

/* Pega todos os campos para passar os valores */
const plan = document.getElementsByClassName('plan')
const price = document.getElementsByClassName('price')
const space = document.getElementsByClassName('space')
const users = document.getElementsByClassName('users')
const transfer = document.getElementsByClassName('transfer')
const btn = document.getElementsByClassName('btn')
const selector = document.getElementById('selector')
const btnSwitch = document.getElementById('button-switch')

// flag boolean para pegar o valor do switch
let isChecked = false;


const listaQuadros = document.querySelectorAll('.component')

for (let campos = 0; campos < listaQuadros.length; campos++) {
    plan[campos].innerHTML = pricingData[campos].title
    price[campos].innerHTML = pricingData[campos].month
    space[campos].innerHTML = pricingData[campos].storage
    users[campos].innerHTML = pricingData[campos].users
    transfer[campos].innerHTML = pricingData[campos].transfer
    btn[campos].innerHTML = pricingData[campos].btn
}

btnSwitch.addEventListener('click', () => {
    isChecked = !isChecked
    btnSwitch.classList.toggle('move')
    for (let i = 0; i < pricingData.length; i++) {
        console.log(pricingData[i])
        if (isChecked) {
            price[i].animate([{
                    // from
                    opacity: 0,
                },
                {
                    // to
                    opacity: 1
                }
            ], 1500)
            price[i].innerText = pricingData[i].year

        } else {
            price[i].animate([{
                    // from
                    opacity: 0
                },
                {
                    // to
                    opacity: 1
                }
            ], 1500)
            price[i].innerText = pricingData[i].month
        }
    }
})
