function loadDoc(n) {
    if(n === 0){
        var xhttp = new XMLHttpRequest();
        var cep = document.getElementById("Cep").value;
        xhttp.open("GET", "https://viacep.com.br/ws/" + cep + "/json/", false);
        xhttp.send();
        var data = JSON.parse(xhttp.responseText);
        document.getElementById("Logradouro").value = data.logradouro;
        document.getElementById("Rua").value = data.logradouro;
        document.getElementById("Bairro").value = data.bairro;
        document.getElementById("Cidade").value = data.localidade;
        document.getElementById("Uf").value = data.uf;
    }
    var xhttp = new XMLHttpRequest();
    var cep = document.getElementById("CepEntrega").value;
    xhttp.open("GET", "https://viacep.com.br/ws/" + cep + "/json/", false);
    xhttp.send();
    var data = JSON.parse(xhttp.responseText);
    document.getElementById("LogradouroEntrega").value = data.logradouro;
    document.getElementById("RuaEntrega").value = data.logradouro;
    document.getElementById("BairroEntrega").value = data.bairro;
    document.getElementById("CidadeEntrega").value = data.localidade;
    document.getElementById("UfEntrega").value = data.uf;
}