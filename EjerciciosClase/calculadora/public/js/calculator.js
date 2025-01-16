const display = document.getElementById('display');

function appendNumber(number) {
    display.value += number;
}

function appendDecimal() {
    if (!display.value.includes('.')) {
        display.value += '.';
    }
}

function clearDisplay() {
    display.value = '';
}

function clearEntry() {
    let parts = display.value.trim().split(/[\s]+/);
    if (parts.length > 0) {
        parts.pop();
    }
    display.value = parts.join(' ');
}

function appendOperation(operation) {
    if (display.value !== '') {
        const lastChar = display.value.trim().slice(-1);
        if (!['+', '-', '*', '/', '%'].includes(lastChar)) {
            display.value += ` ${operation} `;
        }
    }
}

function backspace() {
    let parts = display.value.trim().split(/[\s]+/);
    if (parts.length > 0) {
        let last = parts.pop();
        if (last.length > 1) {
            last = last.slice(0, -1);
            parts.push(last);
        }
    }
    display.value = parts.join(' ');
}

function setOperation(op) {
    if (display.value.trim() === '') {
        alert('Por favor, ingrese un número antes de realizar la operación.');
        return;
    }
    document.getElementById('operation').value = op;
    document.getElementById('calcForm').submit();
}

function toggleSign() {
    let parts = display.value.trim().split(/[\s]+/);
    if (parts.length > 0) {
        let last = parts.pop();
        if (!isNaN(last)) {
            last = parseFloat(last) * -1;
        }
        parts.push(last);
    }
    display.value = parts.join(' ');
}

document.getElementById('calcForm').addEventListener('submit', function (e) {
    const valid = /^[0-9+\-*/().%√x^ ]+$/.test(display.value.trim());
    if (!valid && !document.getElementById('operation').value) {
        alert('La expresión contiene caracteres no válidos.');
        e.preventDefault();
    }
});

console.log('Script cargado correctamente.');
