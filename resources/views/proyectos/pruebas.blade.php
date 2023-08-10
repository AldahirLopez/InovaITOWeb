<form id="curp-form">
    @csrf
    <input type="text" name="curp" placeholder="Ingresa tu CURP" required>
    <button type="submit">Validar CURP</button>
</form>

<div id="curp-result"></div>

<script>
document.getElementById('curp-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch('{{ route('validate.curp') }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const resultDiv = document.getElementById('curp-result');
        
        if (data.status === 'success') {
            const curpData = data.data;
            resultDiv.innerHTML = `
                <p>Nombre: ${curpData.nombre}</p>
                <p>Apellido Paterno: ${curpData.apellidoPaterno}</p>
                <p>Apellido Materno: ${curpData.apellidoMaterno}</p>
                <!-- Agrega más campos según los datos que desees mostrar -->
            `;
        } else {
            resultDiv.innerHTML = data.message;
        }
    })
    .catch(error => {
        console.error(error);
    });
});
</script>
