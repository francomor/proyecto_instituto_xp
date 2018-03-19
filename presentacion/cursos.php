<body onload="cargar()"> <!--cuando se carga el body se ejecuta el cargar cursos -->

    <div id="aca">
        <!--Lista de cursos  -->
    </div>
    
    <script>
        function cargar() //funcion ajax para traer desde cargar_cursos_ed.f-php todos los cursos de la bdd, para luego cargarlo en el select
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("aca").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "../logica/cargar_cursos_ed-f.php", true);
            xmlhttp.send();
        }
    </script>
    
</body>