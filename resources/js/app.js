//importamos Dropzone
import Dropzone from "dropzone";


Dropzone.autoDiscover = false;


//configuaracion
const dropzone = new Dropzone("#dropzone",{
  dictDefaultMessage: "Sube aqui tu imagen", //para mostrar este mensaje
  acceptedFiles: ".png, .jpg, .jpeg, .gif ", // los tipos de formatos de archivos
  addRemoveLinks: true, //esto permite  eliminar la imagen
  dictRemoveFile: 'Borrar Archivo',
  maxFiles: 1, // para guardar de a uno (tambien se puede guardar carruceles de fotos)
  uploadMultiple: false,


  /*lo que hace es que cuando carguemos la img y envie los datos sin el titulo y la descripcion que me deje y me muestre la imagen para poder
  rellenado la el formulario*/
  init: function(){ //este codigo se va a ejecutar solamente si hay un name previo
  if(document.querySelector('[name="imagen"]').value.trim()){
    const imagenPublicada = {};
    imagenPublicada.size = 1234;  //el tamaño de la img, pero por defecto lo dejo asi, aunque esto no importa tanto
    imagenPublicada.name = document.querySelector('[name="imagen"]').value; //este es el nombre de la imagen que estamos guardando

    //son las opciones de dropzone
    this.options.addedfile.call(this, imagenPublicada);       //la direcion donde guarde la imagen
    this.options.thumbnail.call(this, imagenPublicada, `/Uploads/${imagenPublicada.name}`); //para la imagen pequeña

    imagenPublicada.previewElement.classlist.add("dz-success","dz-complete");
}

  },

});
//para ver los estados
            //success en caso de que se suba correctamente
dropzone.on('success', function(file,response ){ //toma callback
     console.log(response.imagen); //que le mando  el nombre de la img y me lo muestra por pantalla en el navegador (js)
     document.querySelector('[name="imagen"]').value =response.imagen; //asignarle al imput hihidden de imagen
   });
     //para ver errores
// dropzone.on('error', function(file,message ){ //toma callback
//     console.log(message); //para poderlo debuguiar
//    });

// dropzone.on('removedfile', function(){ //toma callback
//     console.log('Archivo eliminado'); //que diga archivo eliminado
//    });

//para cuando borremos la imagen no me aparesca en values relleno,para colocarlos en vacio
dropzone.on('removedfile', function() { //toma callback
    document.querySelector('[name="imagen"]').value = ""; //
   });

