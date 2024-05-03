function login() {
    valid = true;
    const inputs = ["username", "password"];

    for (let i = 0; i < inputs.length; i++) {
        const validate = document.getElementById(inputs[i]);
        if (validate.value == "") {
            valid = false;
            validate.focus();
            break;
        }
    }

    if (!valid) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Fill the data correctly.',
            confirmButtonColor: '#2ECC71',
        });
    } else {
        const data = {};
        data["user_username"] = document.getElementById('username').value;
        data["user_password"] = document.getElementById('password').value;

        const url = "http://localhost/miniFrameworkPHP/Login/login";
        
        const headers = new Headers();
        headers.append('Content-Type', 'application/json');
        
        const options = {
            method: 'POST',
            mode: 'same-origin',
            headers: headers,
            body: JSON.stringify(data),
        }
        fetch(url, options)
          .then(response => {
              // Verificar si la solicitud fue exitosa (código de estado 200)
              if (!response.ok) {
                  // Si la respuesta no es exitosa, lanzar un error con el código de estado
                  throw new Error(`La solicitud no fue exitosa. Código de estado: ${response.status}`);
              }
              // Convertir la respuesta a formato JSON
              return response.json();
          })
          .then(data => {
              // Manejar los datos recibidos
              console.log('Respuesta del servidor:', data);
          })
          .catch(error => {
              // Manejar diferentes tipos de errores
              if (error instanceof TypeError) {
                  // Error de red o de CORS bloqueado
                  console.error('Error de red:', error.message);
              } else if (error instanceof Error) {
                  // Error de servidor o de aplicación
                  console.error('Error:', error.message);
              } else {
                  // Otros errores inesperados
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error,
                    confirmButtonColor: '#2ECC71',
                });
                  console.error('Ocurrió un error inesperado:', error);
              }
          });
    }
}