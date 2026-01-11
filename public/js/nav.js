document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('.notif-item').forEach(item => {
    item.addEventListener('click', event => {
      const sectionID = `${(event.currentTarget.dataset.section).trim()}-section`
      const prefix = event.currentTarget.dataset.open
      // const notifTargetValue = (event.currentTarget.dataset.value).trim()
      let section = document.getElementById(sectionID) ?? null;
      hideAllSectionsAndDeselectButtons()
      
      if(section){
        
        section.classList.add('is-shown')

        // setTimeout(() => {
        //   findRowByCode(notifTargetValue)
        // }, 1000);
        
      }
    })

  })

//   document.addEventListener('livewire:initialized', () => {
//       Livewire.on('focusRow', ({ task }) => {
//           const row = document.getElementById('notif-' + task);

//           if (row) {
//               row.scrollIntoView({ behavior: "smooth", block: "center" });
//               row.classList.add("highlight-row");

//               setTimeout(() => row.classList.remove("highlight-row"), 2000);
//           }
//       });

//   });

//   window.addEventListener('scroll-to-highlighted-row', () => {
//     console.log('ready to scroll');
    
//       // const row = document.querySelector('.table-row.bg-warning');
//       // if (row) {
//       //     row.scrollIntoView({ behavior: 'smooth', block: 'center' });
//       // }
//   });
  window.addEventListener('notif-focus', e => {
      console.log('Focus item:', e.detail.id);
  });
  document.body.addEventListener('click', (event) => {
    const sectionEl = event.target.closest('[data-section]');
    const modalEl   = event.target.closest('[data-modal]');

    if (sectionEl) {
      handleSectionTrigger(sectionEl)
    } else if (modalEl) {
      handleModalTrigger(event)
    }
    // if (event.target.dataset.section) {
    //   console.log(event.target);
      
    //   handleSectionTrigger(event)
    // } else if (event.target.dataset.modal) {
    //   handleModalTrigger(event)
    // }
  })
})



function findRowByCode(code) {
    // Select all table rows
    const rows = document.querySelectorAll('.table-row');

    for (let row of rows) {

        // find all <a> inside this row
        const links = row.querySelectorAll('a');

        for (let link of links) {
            if (link.textContent.trim().includes(code)) {

                // OPTIONAL: highlight the row
                row.style.backgroundColor = "#655c35ff";
                row.style.border = "2px solid orange";

                // Scroll to it
                row.scrollIntoView({ behavior: "smooth", block: "center" });

                console.log("Row found:", row);
                return row;
            }
        }
    }

    console.log("Code not found:", code);
    return null;
}

function handleSectionTrigger (element) {
  hideAllSectionsAndDeselectButtons()

  // Highlight clicked button and show view
  const btnAct = `${element.dataset.active}`

  console.log('TEST: '+btnAct);
  

  if(document.getElementById(btnAct)){
    document.getElementById(btnAct).classList.add('active')
  }
  const btnAct2 = `${element.dataset.open}`
  if (document.getElementById(btnAct2)) {
    document.getElementById(btnAct2).classList.add('active')
  }

  // Display the current section
  const sectionId = `${element.dataset.section}-section`
  if(document.getElementById(sectionId)){
    document.getElementById(sectionId).classList.add('is-shown')
  }

  // Save currently active button in localStorage
  const buttonId = element.getAttribute('id')
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
  const sections = document.querySelectorAll('.section.is-shown')
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

