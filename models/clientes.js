const sql = require("./db");

const Clientes = function (Cliente) {
    this.nome = Cliente.nome;
    this.senha = new Buffer(Cliente.senha).toString('base64'); // Faz criptografia da senha
    this.telefone = Cliente.telefone;
    this.endereco = Cliente.endereco;
}

Clientes.create = (newClient, result) => {
    sql.query("INSERT INTO clientes SET ?", newClient, (err, res) => {
        if (err) {
            console.log("Erro: ", err);
            result(err, null);
            return;
        }

        console.log("Cliente criado: ", { id: res.insertId, ...newClient });
        result(null, { id: res.insertId, ...newClient });
    });
};

Clientes.realizalogin = (name, password, result) => {

    var senha = new Buffer(password).toString('base64'); // Faz criptografia da senha para validação no select

    sql.query('SELECT * FROM clientes WHERE nome = ? AND senha = ?', [name, senha] , (err, res) => {

        if (err) {
            console.log("Erro: ", err);
            result(err, null);
            return;
        }

        console.log("Cliente logado: ", res);
        result(null, res);
    });
};

module.exports = Clientes;