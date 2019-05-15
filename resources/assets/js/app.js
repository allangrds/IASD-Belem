import flatpickr from "flatpickr";

document.addEventListener("DOMContentLoaded", function() {
    showFilePath();
    createNewTimeLine();
    createRemoveListeners();
    createNewPhotoInput();

    flatpickr('.dt', {
        altInput: true,
        altFormat: "d/m/Y",
    });
});

function setFilePath (elem) {
    const document = elem.parentNode;
    const value = elem.value;

    if (value) {
        document.getElementsByClassName("file-name")[0].innerHTML = value;
    }
}

function showFilePath() {
    const input = document.getElementsByName('photo[]');

    if (input && input.length > 0) {
        input.forEach((elem) => {
            elem.removeEventListener('change', setFilePath);
            elem.onchange = function () {
                setFilePath(elem);
            };
        });
    }
}

function removeLine() {
    const div = document.getElementsByClassName('new-line')[0];
    const element = this.parentNode.parentNode;

    div.removeChild(element);
}

function createNewTimeLine() {
    const button = document.getElementById('btnNewTitle');

    if (button) {
        button.addEventListener("click", function() {
            const div = document.getElementsByClassName('new-line')[0]
            const newDiv = document.createElement('div');

            newDiv.className = 'columns';
            newDiv.innerHTML = `
                <div class="column">
                    <div class="field">
                        <label class="label" for="time">Horário</label>
                        <div class="control">
                            <input
                                autofocus
                                class="input"
                                name="time[]"
                                required
                                type="time"
                            />
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label class="label" for="title">Título</label>
                        <div class="control">
                            <input
                                autofocus
                                class="input"
                                name="title[]"
                                placeholder="Título"
                                required
                                type="text"
                            />
                        </div>
                    </div>
                </div>
                <div class="column flex align-items-flex-end">
                    <button
                        class="button is-outlined is-danger is-small btn-remove"
                        type="button"
                    >
                        Excluir
                    </button>
                </div>
            `;

            div.appendChild(newDiv);

            createRemoveListeners();
        });
    }
}

function createRemoveListeners () {
    const removeBtn = document.getElementsByClassName('btn-remove');

    if(removeBtn && removeBtn.length > 0) {
        for (let i = 0; i < removeBtn.length; i++) {
            removeBtn[i].removeEventListener('click', removeLine);
            removeBtn[i].addEventListener('click', removeLine);
        }
    }
}

function createNewPhotoInput() {
    const button = document.getElementById('btnNewPhoto');

    if (button) {
        button.addEventListener("click", function() {
            const div = document.getElementsByClassName('new-line')[0]
            const newDiv = document.createElement('div');

            newDiv.className = 'columns';
            newDiv.innerHTML = `
                <div class="column">
                    <div class="field">
                        <div class="file has-name">
                            <label class="file-label">
                                <input class="file-input" type="file" name="photo[]">
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Escolha um arquivo...
                                    </span>
                                </span>
                                <span class="file-name">Local do arquivo</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="column flex align-items-flex-end">
                    <button
                        class="button is-outlined is-danger is-small btn-remove"
                        type="button"
                    >
                        Excluir
                    </button>
                </div>
            `;

            div.appendChild(newDiv);

            createRemoveListeners();
            showFilePath();
        });
    }
}
