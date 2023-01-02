document.body.addEventListener('click', (event) => {
  if (event.target.dataset.section) {
    handleSectionTrigger(event)
  } else if (event.target.dataset.modal) {
    handleModalTrigger(event)
  }
})

function handleSectionTrigger (event) {
  hideAllSectionsAndDeselectButtons()

  // Highlight clicked button and show view
  const btnAct = `${event.target.dataset.active}`
  document.getElementById(btnAct).classList.add('active')

  const btnAct2 = `${event.target.dataset.open}`
  if (btnAct2) {
    document.getElementById(btnAct2).classList.add('active')
  }

  // Display the current section
  const sectionId = `${event.target.dataset.section}-section`
  document.getElementById(sectionId).classList.add('is-shown')

  // Save currently active button in localStorage
  const buttonId = event.target.getAttribute('id')
  localStorage.setItem('activeSectionButtonId', buttonId);
}

function activateDefaultSection () {
  document.getElementById('button-dash').click()
}

function showMainContent () {
  //document.querySelector('.js-nav').classList.add('is-shown')
  document.querySelector('.js-content').classList.add('is-shown')
}

function handleModalTrigger (event) {
  hideAllModals()
  const modalId = `${event.target.dataset.modal}-modal`
  document.getElementById(modalId).classList.add('is-shown')
}

function hideAllModals () {
  const modals = document.querySelectorAll('.modal.is-shown')
  Array.prototype.forEach.call(modals, (modal) => {
    modal.classList.remove('is-shown')
  })
  showMainContent()
}

function hideAllSectionsAndDeselectButtons () {
  const sections = document.querySelectorAll('.js-section.is-shown')
  Array.prototype.forEach.call(sections, (section) => {
    section.classList.remove('is-shown')
  })

  const buttons = document.querySelectorAll('.nav-item.active')
  Array.prototype.forEach.call(buttons, (button) => {
    button.classList.remove('active')
  })
}

function displayAbout () {
  document.querySelector('#about-modal').classList.add('is-shown')
}

// Default to the view that was active the last time the app was open
const sectionId = localStorage.getItem('activeSectionButtonId')
console.log(sectionId)
if (sectionId) {
  //showMainContent()
  Promise.resolve(sectionId).then(function(v){
    const section = document.getElementById(v)
    if (section) section.click()
  })
  
} else {
  const sections = document.querySelectorAll('.js-section.is-shown')
  Array.prototype.forEach.call(sections, (section) => {
      section.classList.remove('is-shown')
  })
  hideAllModals ()
  activateDefaultSection ()
  
}

