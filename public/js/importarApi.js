
  //Consumir api por metodo GET
  const api = new XMLHttpRequest();
  api.open('GET', 'https://mindicador.cl/api/uf', true);
  api.send();
  
  api.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      const datos = JSON.parse(this.responseText);
      console.log(datos);
      const valores = [];
      
      for (let i = 0; i < datos.serie.length; i++) {
        const fechaCompleta = datos.serie[i].fecha;
        const fecha = fechaCompleta.substring(0, 10);
        const valor = datos.serie[i].valor;
        
        const objeto = {
          fecha: fecha,
          valor: valor
        }
        
        valores.push(objeto);
      }
     
      guardarEnBaseDeDatos(valores);
    }
  };

  //Guardar los datos de la api consumida con metodo POST
 function guardarEnBaseDeDatos(valores) {
    const xhr = new XMLHttpRequest();
    const url = 'http://localhost/unidadFomento-app/app/controller/import.controller.php';
    const params = JSON.stringify(valores);
    
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(xhr.responseText);
      }
    };
    xhr.send(params);
  }
  



 
