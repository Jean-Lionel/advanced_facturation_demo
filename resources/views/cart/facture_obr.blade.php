<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire OBR</title>
    <link rel="stylesheet" href="{{ asset('css/print.min.css') }}">

    <script src="{{ asset('js/print.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/facture_obr.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <div class="header-left">
                <img src="logo.png" alt="Logo" class="logo">
                <p style="font-weight: 800;">AMENAGEMENT, CONSTRUCTION, CONSEIL, ETUDE, SURVEILLANCE. "ACOCES"</p>
                <p style="font-weight: 800;">NIF : 40000252082</p>
            </div>
            <div class="header-right">
                <p style="font-weight: 800;">RC : 01098</p>
            </div>
        </header>
        <hr class="thick-line">
        <section class="facture-info">
            <p>Facture no. N860W672047/FN18/2024 , Date : 2024-02-04 11:47:05</p>
        </section>
        <section class="identification">
            <div class="vendeur">
                <p>A. Identification du vendeur</p>
                <p>Personne physique: <input type="checkbox"> | Société: <input type="checkbox" checked></p>
                <p>Centre Fiscal: DGC</p>
                <p>Nom du contribuable: AMENAGEMENT DES MARAIS, CONSTRUCTION, CONSEIL, ETUDES ET SURVEILLANCE</p>
                <p>Secteur d'activité: 010-CONSTRUCTION</p>
                <p>NIF: 400000252082</p>
                <p>Registre de commerce: 01098</p>
                <p>B.P:89 <br>
                    Tél://79972430 <br>
                    Commune: AVENUE DEMOCRATIE <br>
                    Numero:13 </p>
            </div>
            <div class="client">
                <p>B. Client</p>
                <p>Personne physique: <input type="checkbox" checked> | Société: <input type="checkbox"></p>
                <p>Nom: enabel</p>
                <p>NIF: 400000252082</p>
                <p>Resident à: rohero</p>
                <p>Assujetti à la TVA: <input type="checkbox" checked> OUI <input type="checkbox"> NON</p>
            </div>
        </section>
        <section class="tax-info">
            <p>Exonéré à la TVA: <input type="checkbox"> OUI <input type="checkbox" checked> NON</p>
            <p>Assujetti à la TVA: <input type="checkbox" checked> OUI <input type="checkbox"> NON</p>
            <p>Assujetti à la TC: <input type="checkbox"> OUI <input type="checkbox" checked> NON</p>
            <p>Assujetti au PF: <input type="checkbox"> OUI <input type="checkbox" checked> NON</p>
        </section>
        <p>Droit pour ce qui suit</p>
        <section class="articles">
            <table>
                <thead>
                    <tr>
                        <th>Articles</th>
                        <th>Qtés</th>
                        <th>P.U</th>
                        <th>TC</th>
                        <th>A.TAX</th>
                        <th>PV-HTVA</th>
                        <th>TVA</th>
                        <th>TVAC</th>
                        <th>PF</th>
                        <th>PVT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>TRAVAUX DIVERS DE CONSTRUCTION NEUVES ET DE REHABILITATIONS DANS LES CEM DE MUYINGA LOT1, CEM DE KINAMA, GIHANGA, BUBANZA ET DE CANKUZO LOT2, CEM LOT3, LOT2</td>
                        <td>1</td>
                        <td>20,804.97</td>
                        <td>0</td>
                        <td>0</td>
                        <td>20,804.97</td>
                        <td>3,744.895</td>
                        <td>24,549.87</td>
                        <td>0</td>
                        <td>24,549.87</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">TOTAL (EUR)</td>
                        <td>20,804.97</td>
                        <td>3,744.895</td>
                        <td>24,549.87</td>
                        <td>0</td>
                        <td>24,549.87</td>
                    </tr>
                </tfoot>
            </table>
            <p class="id-info">ID: 4000252082/N860W672047/202406514705/N860W672047/FN18/2024</p>
        </section>
        <section >
            <p>Ce montant est à verser sur le compete n :<strong>4491939667 EUROS ouvert àla Banque Populaire du Rwanda au nom de l'Entreprise LTD.</strong></p>
        </section>
        <div class="signature-section">
            <div class="signature-box">
                <p>POUR L'ACCORD</p>
                <p>KARORERO Rodrique</p>
                <p>Directeur General</p>
            </div>
        </div>

        <footer>
            <p>Avenue de la démocratie N° 13 Téléphone (+257) 79 97 5430 / +257 18 864 827 - Email: kar...ka_pr@gmail.com / exemple1@gmail.com / info@acoces.org</p>
        </footer>
    </div>
</body>
</html>
