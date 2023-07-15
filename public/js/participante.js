class Formulario {
    constructor() {
        this.selectElement = document.getElementById("expectativa");
        this.espectativa = [];
    }

    cargarEspectativa() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "/espectativa", true);
        xhr.onload = () => {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                this.espectativa = response;
                //console.log(espectativa); 
                this.renderizarEspectativa();
                this.cargarCarrera();
            }
        };
        xhr.send();
    }

    cargarCarrera() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "/carrera", true);
        xhr.onload = () => {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const carrera = response;
                this.renderizarCarrera(carrera);
            } 
        };
        xhr.send();
    }

    renderizarCarrera(carreras) {
        const selectElement = document.getElementById("carrera");

        // Elimina todas las opciones existentes en el select
        selectElement.innerHTML = "";

        // Agrega una opción vacía por defecto
        let emptyOption = document.createElement("option");
        emptyOption.text = "Seleccione una opción";
        selectElement.appendChild(emptyOption);

        // Agrega las opciones recibidas al select
        carreras.forEach((carrera) => {
            const nombre = carrera.Nombre_carrera;
            const clave = carrera.Id_carrera;

            const option = document.createElement("option");
            option.text = nombre;
            option.value = clave;
            selectElement.appendChild(option);
        });

        // Agregar evento de cambio al select
        selectElement.addEventListener('change', (event) => {
            const selectedValue = event.target.value;
            console.log(selectedValue);
        });
        
    }

    renderizarEspectativa() {
        // Agregar opción vacía con el texto "Seleccione una opción por favor"
        let emptyOption = document.createElement("option");
        emptyOption.text = "Seleccione una opción por favor";
        this.selectElement.add(emptyOption);

        for (let i = 0; i < this.espectativa.length; i++) {
            let option = document.createElement("option");

            // Verificar si la propiedad 'Tipo_tec' existe en el objeto
            if ('Expectativa' in this.espectativa[i]) {
                option.text = this.espectativa[i].Expectativa; // Mostrar el nombre
            } else {
                // Si no existe la propiedad 'Tipo_tec', muestra todo el objeto como texto
                option.text = JSON.stringify(this.espectativa[i]);
            }

            // Asignar el valor del objeto completo al atributo 'value' del option
            option.value = this.espectativa[i].Id_expectativa;

            this.selectElement.add(option);
        }

        // Agregar evento de cambio al select
        this.selectElement.addEventListener('change', () => {
            const selectedValue = this.selectElement.value;
            console.log(selectedValue);
        });
        
    }


}

const formulario = new Formulario();
formulario.cargarEspectativa();
