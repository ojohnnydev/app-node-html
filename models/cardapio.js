const sql = require("./db");

const Cardapio = function (Cardapio) {
    this.item_1 = Cardapio.item_1;
    this.item_2 = Cardapio.item_2;
    this.item_3 = Cardapio.item_3;
    this.salada = Cardapio.salada;
    this.carne = Cardapio.carne;
    this.bebida = Cardapio.bebida;
    this.sobremesa = Cardapio.sobremesa;
}

Cardapio.getAll = result => {
    sql.query("SELECT * FROM cardapio", (err, res) => {
        if (err) {
            console.log("Erro: ", err);
            result(err, null);
            return;
        }

        console.log("Cardápio: ", res);
        result(null, res);
    });
};

module.exports = Cardapio;