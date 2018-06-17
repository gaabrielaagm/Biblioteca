//window.onload=cargar;
//var tema;

function cargar($scope){
    $scope.asignaturas=[ //Generalidades por default
        {name:'Bibliografía',value: 1},
        {name:'Bibliotecnologia',value: 2},
        {name:'Enciclopedias Generales',value: 3},
        {name:'Publicaciones en serie', value: 5},
        {name:'Organizaciones y Museografía', value: 6},
        {name:'Periodismo, Editoriales, Diarios', value: 7},
        {name:'Colecciones generales', value: 8},
        {name:'Manuscritos y libros raros', value: 9}
    ];
    var temas = document.getElementById("tema");
    temas.addEventListener("click", function() {
        if(tema.value=="0"){ //Generalidades
            $scope.asignaturas=[ 
                {name:'Bibliografía',value: 1},
                {name:'Bibliotecnologia',value: 2},
                {name:'Enciclopedias Generales',value: 3},
                {name:'Publicaciones en serie', value: 5},
                {name:'Organizaciones y Museografía', value: 6},
                {name:'Periodismo, Editoriales, Diarios', value: 7},
                {name:'Colecciones generales', value: 8},
                {name:'Manuscritos y libros raros', value: 9}
            ];
        }
        if(tema.value=="1"){ //Filosofia 
            $scope.asignaturas=[
                {name:'Metafísica',value: 1},
                {name:'Conocimiento, Causa, Fin, Hombre',value: 2},
                {name:'Parapsicologia, Ocultismo',value: 3},
                {name:'Puntos de vista Filosoficos', value: 4},
                {name:'Psicología', value: 5},
                {name:'Lógica', value: 6},
                {name:'Ética (Filosofía Moral)', value: 7},
                {name:'Filosofía Antigua, Medieval. Oriental', value: 8},
                {name:'Filosofía Moderna Occidental', value: 9},
            ];
        }
        if(tema.value=="2"){ //Religion 
            $scope.asignaturas=[
                {name:'Religión Natural',value: 1},
                {name:'Biblia',value: 2},
                {name:'Teología Cristiana',value: 3},
                {name:'Moral y Prácticas Cristianas', value: 4},
                {name:'Iglesia Local y Ordenes Religiosas', value: 5},
                {name:'Teología Social y Eclesiología', value: 6},
                {name:'Historia y Geografía de la Iglesia', value: 7},
                {name:'Credos de la Iglesia Cristiana', value: 8},
                {name:'Otras religiones', value: 9},
            ];
        }
        if(tema.value=="3"){ //Ciencias Sociales 
            $scope.asignaturas=[
                {name:'Estadísticas',value: 1},
                {name:'Ciencia Política',value: 2},
                {name:'Economía', value: 3},
                {name:'Derecho', value: 4},
                {name:'Administración Pública', value: 5},
                {name:'Patología y Servicios Sociales', value: 6},
                {name:'Educación', value: 7},
                {name:'Comercio', value: 8},
                {name:'Costumbres y Folklore', value: 9},
            ];
        }
        if(tema.value=="4"){ //Lenguas
            $scope.asignaturas=[
                {name:'Lingüistica',value: 1},
                {name:'Ingles y Anglosagon',value: 2},
                {name:'Lenguas Germánicas; Aleman', value: 3},
                {name:'Lenguas Romances; Frances', value: 4},
                {name:'Italiano, Romano, Rético', value: 5},
                {name:'Español y Portugues', value: 6},
                {name:'Lenguas Italicas; Latin', value: 7},
                {name:'Lenguas helenicas; Griego', value: 8},
                {name:'Otras Lenguas', value: 9},
            ];
        }
        $scope.$apply();
    });
}
