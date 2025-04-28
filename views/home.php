<?php
if (isset($_SESSION['error'])) {
    echo '<div class="error">'.htmlspecialchars($_SESSION['error']).'</div>';
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcul taxes foncières</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .error { background: #f2dede; color: #a94442; padding: 10px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        .property-section { border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; }
        button { background: #4CAF50; color: white; padding: 10px 15px; border: none; cursor: pointer; }
        button:hover { background: #45a049; }
        .hidden { display: none; }
    </style>
</head>
<body>
    <h1>Calcul des taxes foncières</h1>
    
    <form action="index.php?action=calculateTax" method="post">
        <!-- Propriétaire -->
        <div class="form-group">
            <label for="firstName">Prénom*</label>
            <input type="text" id="firstName" name="firstName" required>
        </div>
        
        <div class="form-group">
            <label for="lastName">Nom*</label>
            <input type="text" id="lastName" name="lastName" required>
        </div>

        <!-- Type de bien -->
        <div class="form-group">
            <label for="propertyType">Type de bien*</label>
            <select id="propertyType" name="propertyType" required onchange="togglePropertyFields()">
                <option value="">-- Sélectionnez --</option>
                <option value="flat">Appartement</option>
                <option value="house">Maison</option>
            </select>
        </div>

        <!-- Section Appartement -->
        <div id="flatSection" class="property-section hidden">
            <h2>Appartement</h2>
            <div class="form-group">
                <label for="flatRegion">Région*</label>
                <select id="flatRegion" name="flatRegion" onchange="showFlatRegionInput(this)">
                    <option value="">-- Sélectionnez --</option>
                    <option value="Occitanie">Occitanie</option>
                    <option value="Autre">Autre région</option>
                </select>
                <input type="text" id="flatRegionName" name="flatRegionName" placeholder="Précisez la région" style="display:none; margin-top:10px;">
            </div>

            <div class="form-group">
                <label for="flatCity">Ville*</label>
                <input type="text" id="flatCity" name="flatCity">
            </div>

            <div class="form-group">
                <label for="flatSurface">Surface (m²)*</label>
                <input type="number" id="flatSurface" name="flatSurface" min="1">
            </div>

            <div class="form-group">
                <label for="flatFloor">Étage*</label>
                <input type="number" id="flatFloor" name="flatFloor" min="0">
            </div>
        </div>

        <!-- Section Maison -->
        <div id="houseSection" class="property-section hidden">
            <h2>Maison</h2>
            <div class="form-group">
                <label for="houseRegion">Région*</label>
                <select id="houseRegion" name="houseRegion" onchange="showHouseRegionInput(this)">
                    <option value="">-- Sélectionnez --</option>
                    <option value="Occitanie">Occitanie</option>
                    <option value="Autre">Autre région</option>
                </select>
                <input type="text" id="houseRegionName" name="houseRegionName" placeholder="Précisez la région" style="display:none; margin-top:10px;">
            </div>

            <div class="form-group">
                <label for="houseCity">Ville*</label>
                <input type="text" id="houseCity" name="houseCity">
            </div>

            <div class="form-group">
                <label for="houseSurface">Surface (m²)*</label>
                <input type="number" id="houseSurface" name="houseSurface" min="1">
            </div>

            <div class="form-group">
                <label for="hasPool">Piscine</label>
                <input type="checkbox" id="hasPool" name="hasPool" value="1">
            </div>
        </div>

        <button type="submit">Calculer la taxe</button>
    </form>

    <script>
        function togglePropertyFields() {
            const type = document.getElementById('propertyType').value;
            document.getElementById('flatSection').classList.add('hidden');
            document.getElementById('houseSection').classList.add('hidden');

            if (type === 'flat') {
                document.getElementById('flatSection').classList.remove('hidden');
            } else if (type === 'house') {
                document.getElementById('houseSection').classList.remove('hidden');
            }
        }

        function showFlatRegionInput(select) {
            const input = document.getElementById('flatRegionName');
            input.style.display = select.value === 'Autre' ? 'block' : 'none';
        }

        function showHouseRegionInput(select) {
            const input = document.getElementById('houseRegionName');
            input.style.display = select.value === 'Autre' ? 'block' : 'none';
        }
    </script>
</body>
</html>
