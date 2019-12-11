var form = document.querySelector('form');


form.addEventListener('submit', function (event) {

    removeError(); // убирает div с ошибкой, ибо складируется

    let fields = form.querySelectorAll('.valid-input');

    if(!empty(fields)){event.preventDefault(); return false;}

    if(!checkSpace(fields)){event.preventDefault(); return false;}

    if(!checkDigit(fields)){event.preventDefault(); return false;}

    if(!checkFile(fields)){event.preventDefault(); return false;}

    form.submit();

});

function genericError(text) {

    var error = document.createElement('div')
    error.className='error'
    error.style.color = '#d63031'
    error.style.background = '#fab1a0'
    error.innerHTML = text;

return error;
}

function empty(fields) {
    let count = 0;

    for(let i = 0; i < fields.length; i++)
    {

        if(fields[i].value === '')
        {
            let error = genericError('Поле не должно быть пустым');
            form[0].parentElement.insertBefore(error, fields[0]);
            return false;
        }
    }
    return true;
}

function removeError() {

    var errors = form.querySelectorAll('.error')

    for (var i = 0; i < errors.length; i++) {
        errors[i].remove()
    }
}

function checkSpace(fields) {

    for (let i = 0; i < fields.length; i++) {

        if (!(fields[i].value.trim() !== '')) {
            let error = genericError('Поле не может состоять из пробелов');
            form[0].parentElement.insertBefore(error, fields[0])
            return false;
        }
    }
    return true;
}

function checkDigit(fields) {

    let res1 = fields[1].value.match(/\D/);
    let res2 = fields[3].value.match(/\D/);

    let res3 = fields[2].value.match(/\d/);
    let res4 = fields[4].value.match(/\d/);

        if (res1 || res2) {
            let error = genericError('У полей year и age численные значения');
            fields[0].parentElement.insertBefore(error, fields[0]);
            return false;
        }

        if (res3 || res4) {
            let error = genericError('У полей genre и country не может быть численных значений');
            fields[0].parentElement.insertBefore(error, fields[0]);
            return false;
        }

    return true;
}

function checkFile(fields) {

    let file_input = $('#file_input');

    if(file_input.val() !== '') return true;

    else
    {
        let error = genericError("Загрузка файла обязательна!");
        form[0].parentElement.insertBefore(error, fields[0]);
        return false;
    }
    
}