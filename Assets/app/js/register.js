function validate() {
    const username = document.getElementById('username');
    const usernameLabel = document.getElementById('username_label');
    const mail = document.getElementById('mail');
    const mailLabel = document.getElementById('mail_label');
    const passWord = document.getElementById('password');
    const passWordLabel = document.getElementById('password_label');
    const confirmPassword = document.getElementById('confirmPassword');
    const confirmPasswordLabel = document.getElementById('confirmPasswordLabel');
    let valid = true;

    if (username.value === '') {
        valid = false;
        username.focus();
        usernameLabel.className = "form-label text-danger";
        username.className = "form-control border-danger";
    } else {
        usernameLabel.className = "form-label";
        username.className = "form-control";
    }

    const validMail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    if (!validMail.test(mail.value)) {
        valid = false;
        mail.focus();
        mailLabel.className = "form-label text-danger";
        mail.className = "form-control border-danger";
    } else {
        mailLabel.className = "form-label";
        mail.className = "form-control";
    }
    
    const validPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[\W]).{8,25}$/;
    if (!validPass.test(passWord.value)) {
        valid = false;
        passWord.focus();
        passWordLabel.className = "form-label text-danger";
        passWord.className = "form-control border-danger";
    } else {
        passWordLabel.className = "form-label";
        passWord.className = "form-control";
    }
    
    if (passWord.value !== confirmPassword.value) {
        valid = false;
        confirmPassword.focus();
        confirmPasswordLabel.className = "form-label text-danger";
        confirmPassword.className = "form-control border-danger";
    } else {
        confirmPasswordLabel.className = "form-label";
        confirmPassword.className = "form-control";
    }

    return valid;
}

function register() {
    const valid = validate();

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
        data["user_mail"] = document.getElementById('mail').value;
        data["user_password"] = document.getElementById('password').value;

        const url = "http://localhost/miniFrameworkPHP/Register/save";
        
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
                  console.error('Ocurrió un error inesperado:', error);
              }
          });
    }
}

function fetchExample () {
    // URL de la API
    const apiUrl = 'https://api.example.com/users';
    
    // Datos del usuario a enviar en la solicitud
    const userData = {
      username: 'ejemplo',
      email: 'ejemplo@example.com'
    };
    
    // Token de autenticación JWT
    const authToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c';
    
    // Encabezados personalizados
    const headers = new Headers();
    headers.append('Content-Type', 'application/json');
    headers.append('Authorization', `Bearer ${authToken}`);
    
    // Opciones de la solicitud
    const options = {
      method: 'POST', // Método HTTP
      headers: headers, // Encabezados personalizados
      body: JSON.stringify(userData) // Cuerpo de la solicitud convertido a JSON
    };
    
    // Realizar la solicitud usando fetch() con las opciones personalizadas
    fetch(apiUrl, options)
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
          console.error('Ocurrió un error inesperado:', error);
        }
      });

}