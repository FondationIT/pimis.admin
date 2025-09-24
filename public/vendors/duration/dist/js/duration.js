// flatpickr("#dateAct", {
//     mode: "range",             // this enables FROM–TO selection
//     dateFormat: "Y-m-d",       // format 2025-09-22
//     allowInput: true
// });

(function(){
    const display = document.getElementById('display');
    const displayValue = document.getElementById('displayValue');
    const backdrop = document.getElementById('backdrop');
    const fromInput = document.getElementById('from');
    const toInput = document.getElementById('to');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const clearBtn = document.getElementById('clearBtn');
    const errMsg = document.getElementById('errMsg');
    const deInput = document.getElementById('deInput');
    const aInput = document.getElementById('aInput');
    const durationInfo = document.getElementById('durationInfo');

    // Helper: format datetime-local value into readable string
    function formatLocal(dtStr){
    if(!dtStr) return '';
    const d = new Date(dtStr);
    if(isNaN(d)) return dtStr;
    // e.g. 24 Sep 2025, 09:00
    const datePart = d.toLocaleDateString(undefined,{year:'numeric',month:'short',day:'numeric'});
    const timePart = d.toLocaleTimeString(undefined,{hour:'2-digit',minute:'2-digit'});
    return `${datePart} ${timePart}`;
    }

    function openPicker(){
    backdrop.style.display = 'flex';
    backdrop.setAttribute('aria-hidden','false');
    // prefill picker with existing values if any
    if(deInput.value) fromInput.value = deInput.value;
    if(aInput.value) toInput.value = aInput.value;
    // focus first input
    setTimeout(()=> fromInput.focus(),50);
    }
    function closePicker(){
    backdrop.style.display = 'none';
    backdrop.setAttribute('aria-hidden','true');
    errMsg.style.display = 'none';
    }

    function setRange(fromVal, toVal){
    deInput.value = fromVal || '';
    aInput.value = toVal || '';

    if(fromVal && toVal){
        displayValue.textContent = `${formatLocal(fromVal)} → ${formatLocal(toVal)}`;
        // show duration
        const diffMs = new Date(toVal) - new Date(fromVal);
        if(diffMs>0){
        const minutes = Math.round(diffMs / 60000);
        const h = Math.floor(minutes / 60);
        const m = minutes % 60;
        durationInfo.textContent = `Duration: ${h}h ${m}m`;
        } else {
        durationInfo.textContent = '';
        }
    } else {
        displayValue.textContent = 'Select date & time range';
        durationInfo.textContent = '';
    }
    }

    // open on click or Enter/Space
    display.addEventListener('click', openPicker);
    display.addEventListener('keydown', function(e){
    if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openPicker(); }
    });

    cancelBtn.addEventListener('click', function(e){
    e.preventDefault();
    closePicker();
    });

    saveBtn.addEventListener('click', function(e){
    e.preventDefault();
    const fromVal = fromInput.value;
    const toVal = toInput.value;

    if(!fromVal || !toVal){ errMsg.textContent = 'Both start and end required'; errMsg.style.display='block'; return; }
    if(new Date(toVal) <= new Date(fromVal)){
        errMsg.textContent = 'End must be after start';
        errMsg.style.display = 'block';
        return;
    }
    errMsg.style.display = 'none';
    setRange(fromVal, toVal);
    closePicker();
    });

    clearBtn.addEventListener('click', function(e){
    e.preventDefault();
    setRange('','');
    fromInput.value = '';
    toInput.value = '';
    });

    // close click outside
    backdrop.addEventListener('click', function(e){
    if(e.target === backdrop) closePicker();
    });

    // keyboard: Esc to close
    document.addEventListener('keydown', function(e){
    if(e.key === 'Escape' && backdrop.style.display === 'flex') {
        closePicker();
    }
    });

    // When form submits, the hidden inputs 'de' and 'a' will be sent.
    // For demo, intercept submit to show values:
    document.getElementById('demoForm').addEventListener('submit', function(e){
    // remove the next block in production:
    e.preventDefault();
    alert('Will submit:\n de = ' + deInput.value + '\n a = ' + aInput.value);
    });

    document.querySelectorAll('input[type="date"]').forEach(input => {
        input.addEventListener('input', () => {
            if (input.value) {
                input.classList.remove('error-val'); // remove warning when a date is picked
            }
        });
    });

    // initial state (no value)
    setRange('','');
    
})();

