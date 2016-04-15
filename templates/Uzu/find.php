<h2>Cautare</h2>
<form class="find-form" method="GET" action="/findnews/">
    <p>
        <label for="location">Regiunea</label>
        <select name="id_loc" id="location">
            <option value>-</option>
            <option value="1">Balti</option>
            <option value="2">Chisinau</option>
            <option value="3">Orhei</option>
        </select>
    </p>

    <p>
        <label for="categor">Tipul ofertei</label>
        <select name="categorie" id="categor">
            <option value>-</option>
            <option value="1">Vinzare</option>
            <option value="2">Schimbare</option>
            <option value="3">Chirie</option>
        </select>
    </p>

    <p>
        <label for="nr_cam">Nr. de camere</label>
        <input type="text" name="nr_cam" id="camere">
    </p>

    <p>
        <label for="starea">Starea</label>
        <select name="starea" id="starea">
            <option value>-</option>
            <option value="1">Euro reparatie</option>
            <option value="2">Necesita reparatie</option>
        </select>
    </p>

    <p class="fint-pret">
        <label for="marimea">Aria in m2</label>
        <span>
            <input id="marimea" name="m_dela" type="text" placeholder="De la">
            <input id="marimea2" name="m_pin" type="text" placeholder="Pin la">
        </span>
    </p>

    <p class="fint-pret">
        <label for="pret1">Pretul</label>
        <span>
            <input id="pret1" name="p_dela" type="text" placeholder="De la">
            <input id="pret2" name="p_pin" type="text" placeholder="Pin la">
        </span>
    </p>
    <button type="submits"><i class="fa fa-search"></i> Cautare</button>
</form>