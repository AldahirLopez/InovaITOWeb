class Formulario2 {
    constructor() {
        this.selectElement = document.getElementById("categoria");
        this.categorias = [];
    }

    cargarCategorias() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "/categorias", true);
        xhr.onload = () => {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                this.categorias = response;
                this.renderizarCategorias();
                this.cargarNaturaleza();
                
            }
        };

        xhr.send();
    }

    renderizarCategorias() {
        // Agregar opción vacía con el texto "Seleccione una opción por favor"
        let emptyOption = document.createElement("option");
        emptyOption.text = "Seleccione una opción por favor";
        this.selectElement.add(emptyOption);

        for (let i = 0; i < this.categorias.length; i++) {
            let option = document.createElement("option");

            // Verificar si la propiedad 'Tipo_tec' existe en el objeto
            if ('Nombre_categoria' in this.categorias[i]) {
                option.text = this.categorias[i].Nombre_categoria; // Mostrar el nombre
            } else {
                // Si no existe la propiedad 'Tipo_tec', muestra todo el objeto como texto
                option.text = JSON.stringify(this.categorias[i]);
            }

            // Asignar el valor del objeto completo al atributo 'value' del option
            option.value = this.categorias[i].Id_categoria;

            this.selectElement.add(option);
        }

        // Agregar evento de cambio al select
        this.selectElement.addEventListener('change', () => {
            const selectedValue = this.selectElement.value;
            console.log(selectedValue);
            this.cargarAreas(selectedValue);
        });

    }

    cargarAreas(selectedValue) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `/areas/${selectedValue}`, true);
        xhr.onload = () => {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const opciones = response.opciones;
                this.renderizarAreas(opciones);
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

    renderizarAreas(opciones) {
        const selectElement = document.getElementById("areaAplicacion");

        // Elimina todas las opciones existentes en el select
        selectElement.innerHTML = "";

        // Agrega una opción vacía por defecto
        let emptyOption = document.createElement("option");
        emptyOption.text = "Seleccione una opción";
        selectElement.appendChild(emptyOption);

        // Agrega las opciones recibidas al select
        opciones.forEach((opcion) => {
            const nombre = opcion.Nombre_area;
            const clave = opcion.Id_area;

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

    cargarNaturaleza() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "/naturalezaTecnica", true);
        xhr.onload = () => {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const opciones = response.opciones;
                console.log(opciones); // Agrega este mensaje de depuración

                this.renderizarNaturaleza(opciones);
            }
        };
        xhr.send();
    }

    renderizarNaturaleza(opciones) {
        const selectElement = document.getElementById("naturalezaTecnica");

        // Elimina todas las opciones existentes en el select
        selectElement.innerHTML = "";

        // Agrega una opción vacía por defecto
        let emptyOption = document.createElement("option");
        emptyOption.text = "Seleccione una opción";
        selectElement.appendChild(emptyOption);

        // Agrega las opciones recibidas al select
        opciones.forEach((opcion) => {
            const clave = opcion.Id_naturalezaTecnica;
            const nombre = opcion.Tipo;

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


}
const formulario2 = new Formulario2();
formulario2.cargarCategorias();
