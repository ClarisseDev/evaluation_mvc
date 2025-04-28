<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat des taxes</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .add-property { margin-top: 30px; padding: 20px; border: 1px solid #ddd; background: #f9f9f9; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        .hidden { display: none; }
    </style>
</head>
<body>

    <h1>Résultat des taxes foncières</h1>
    
    <p><?= htmlspecialchars($owner->getFirstName()) ?> <?= htmlspecialchars($owner->getLastName()) ?> possède :</p>
    
    <ul>
        <?php foreach ($owner->getProperties() as $property): ?>
            <li>
                <?php if ($property instanceof Flat): ?>
                    1 appartement (<?= htmlspecialchars($property->getCity()) ?>, <?= htmlspecialchars($property->getRegion()) ?>)
                    de <?= $property->getSurface() ?> m² étage <?= $property->getFloor() ?> :
                    <?= $property->calculateTax() ?>€
                <?php else: ?>
                    1 maison (<?= htmlspecialchars($property->getCity()) ?>, <?= htmlspecialchars($property->getRegion()) ?>)
                    de <?= $property->getSurface() ?> m²
                    <?= $property->getHasPool() ? 'avec Piscine' : 'sans Piscine' ?> :
                    <?= $property->calculateTax() ?>€
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <h3>Total des taxes foncières : <?= $totalTax ?> €</h3>
    
    <div class="add-property">
        <h2>Ajouter un autre bien</h2>

        <form action="index.php?action=calculateTax" method="post">
            <input type="hidden" name="ownerId" value="<?= (int)$owner->getId() ?>">
            
            <div class="form-group">
                <label>Type de bien*</label>
                <select name="propertyType" required onchange="togglePropertyFields()">
                    <option value="">-- Sélectionnez --</option>
                    <option value="flat">Appartement</option>
                    <option value="house">Maison</option>
                </select>
            </div>

            <div class="form-group">
                <label>Région*</label>
                <select name="region" required onchange="showResultRegionInput(this)">
                    <option value="">-- Sélectionnez --</option>
                    <option value="Occitanie">Occitanie</option>
                    <option value="Autre">Autre région</option>
                </select>
                <input type="text" id="regionName" name="regionName" placeholder="Précisez la région" style="display:none; margin-top:10px;">
            </div>

            <div class="form-group">
                <label>Ville*</label>
                <input type="text" name="city" required>
            </div>

            <div class="form-group">
                <label>Surface (m²)*</label>
                <input type="number" name="surface" min="1" required>
            </div>

            <div id="flatFields" style="display:none;">
                <div class="form-group">
                    <label>Étage</label>
                    <input type="number" name="floor" min="0">
                </div>
            </div>

            <div id="houseFields" style="display:none;">
                <div class="form-group">
                    <label><input type="checkbox" name="hasPool" value="1"> Avec piscine</label>
                </div>
            </div>

            <button type="submit">Ajouter ce bien</button>
        </form>
    </div>

    <br>
    <a href="index.php">Retourner au formulaire principal</a>

    <script>
        function togglePropertyFields() {
            const type = document.querySelector('[name="propertyType"]').value;
            document.getElementById('flatFields').style.display = type === 'flat' ? 'block' : 'none';
            document.getElementById('houseFields').style.display = type === 'house' ? 'block' : 'none';
        }

        function showResultRegionInput(select) {
            const input = document.getElementById('regionName');
            input.style.display = select.value === 'Autre' ? 'block' : 'none';
        }
    </script>

</body>
</html>
