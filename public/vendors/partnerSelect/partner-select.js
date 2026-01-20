// const toggleBtn = document.getElementById('toggleDropdown');
// const dropdown = document.getElementById('agentDropdown');
// const selectedBox = document.getElementById('selectedAgents');

// toggleBtn.addEventListener('click', () => {
//     dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
// });

// document.addEventListener('click', (e) => {
//     if (!e.target.closest('.multi-select')) {
//         dropdown.style.display = 'none';
//     }
// });

// document.querySelectorAll('.agent-checkbox').forEach(cb => {
//     cb.addEventListener('change', updateSelected);
// });

// function updateSelected() {
//     selectedBox.innerHTML = '';
//     const checked = document.querySelectorAll('.agent-checkbox:checked');

//     toggleBtn.textContent = checked.length
//         ? checked.length + ' participant(s) sélectionné(s)'
//         : 'Sélectionner les participants';

//     checked.forEach(cb => {
//         const div = document.createElement('div');
//         div.className = 'selected-item';
//         div.innerHTML = `
//             <i>✔</i>
//             ${cb.dataset.name}
//             <span data-id="${cb.value}">×</span>
//         `;
//         selectedBox.appendChild(div);
//     });
// }

// selectedBox.addEventListener('click', (e) => {
//     if (e.target.tagName === 'SPAN') {
//         const id = e.target.dataset.id;
//         document.querySelector(`.agent-checkbox[value="${id}"]`).checked = false;
//         updateSelected();
//     }
// });
