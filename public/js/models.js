class Formulario {
    constructor() {
        this.selectElement = document.getElementById("institutos");
        this.institutos = [];
    }

    cargarInstitutos() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "/centros", true);
        xhr.onload = () => {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                this.institutos = response;
                this.renderizarInstitutos();
            }
        };
        xhr.send();
    }

    cargarOpciones(selectedValue) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `/centroTecnologicos/${selectedValue}`, true);
        xhr.onload = () => {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const opciones = response.opciones;
                this.renderizarOpciones(opciones);
                console.log(opciones); // Verificar los datos recibidos en la consola
                // Resto del código para manipular los datos recibidos
            } else if (xhr.status === 404) {
                console.log("No se encontraron resultados para el Id_tipoTec dado");
            } else {
                console.log("Error en la solicitud");
            }
        };
        xhr.send();
    }

    cargarDepartamentos(selectedValue) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `/centroDepartamentos/${selectedValue}`, true);
        xhr.onload = () => {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const opciones = response.opciones;
                this.renderizarDepartamentos(opciones);
                console.log(opciones); // Verificar los datos recibidos en la consola
                // Resto del código para manipular los datos recibidos
            } else if (xhr.status === 404) {
                console.log("No se encontraron resultados para el Id_tipoTec dado");
            } else {
                console.log("Error en la solicitud");
            }
        };
        xhr.send();
    }

    renderizarInstitutos() {
        // Agregar opción vacía con el texto "Seleccione una opción por favor"
        let emptyOption = document.createElement("option");
        emptyOption.text = "Seleccione una opción por favor";
        this.selectElement.add(emptyOption);

        for (let i = 0; i < this.institutos.length; i++) {
            let option = document.createElement("option");

            // Verificar si la propiedad 'Tipo_tec' existe en el objeto
            if ('Tipo_tec' in this.institutos[i]) {
                option.text = this.institutos[i].Tipo_tec; // Mostrar el nombre
            } else {
                // Si no existe la propiedad 'Tipo_tec', muestra todo el objeto como texto
                option.text = JSON.stringify(this.institutos[i]);
            }

            // Asignar el valor del objeto completo al atributo 'value' del option
            option.value = this.institutos[i].Id_tipoTec;

            this.selectElement.add(option);
        }

        // Agregar evento de cambio al select
        this.selectElement.addEventListener('change', () => {
            const selectedValue = this.selectElement.value;
            console.log(selectedValue);
            this.cargarOpciones(selectedValue);
        });
        
    }

    renderizarOpciones(opciones) {
        const selectElement = document.getElementById("CentrosOpciones");

        // Elimina todas las opciones existentes en el select
        selectElement.innerHTML = "";

        // Agrega una opción vacía por defecto
        let emptyOption = document.createElement("option");
        emptyOption.text = "Seleccione una opción";
        selectElement.appendChild(emptyOption);

        // Agrega las opciones recibidas al select
        opciones.forEach((opcion) => {
            const nombre = opcion.Nombre_tecnologico;
            const clave = opcion.Clave_tecnologico;

            const option = document.createElement("option");
            option.text = nombre;
            option.value = clave;
            selectElement.appendChild(option);
        });

        // Agregar evento de cambio al select
        selectElement.addEventListener('change', (event) => {
            const selectedValue = event.target.value;
            console.log(selectedValue);
            this.cargarDepartamentos(selectedValue);
        });
        
    }


    renderizarDepartamentos(opciones) {
        const selectElement = document.getElementById("CentroDepartamentos");

        // Elimina todas las opciones existentes en el select
        selectElement.innerHTML = "";

        // Agrega una opción vacía por defecto
        let emptyOption = document.createElement("option");
        emptyOption.text = "Seleccione una opción";
        selectElement.appendChild(emptyOption);

        // Agrega las opciones recibidas al select
        opciones.forEach((opcion) => {
            const nombre = opcion.Nombre_departamento;
            const option = document.createElement("option");
            option.text = nombre;
            option.value = nombre;
            selectElement.appendChild(option);
            option.value = opcion.Id_departamento;
        });
    }
}

const formulario = new Formulario();
formulario.cargarInstitutos();
