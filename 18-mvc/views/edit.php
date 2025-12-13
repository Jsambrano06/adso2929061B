<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokemon</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col">
            <div class="text-center mb-4">
                <h1 class="text-5xl font-bold">Editar Pokemon</h1>
                <p class="py-2">Modifica la información de <?= htmlspecialchars($data['pokemon']['name']) ?></p>
            </div>
            <div class="card bg-base-100 w-full max-w-lg shrink-0 shadow-2xl">
                <form class="card-body" method="POST" action="<?= $data['url'] ?>update/<?= htmlspecialchars($data['pokemon']['id']) ?>">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">ID</span>
                            </label>
                            <input type="text" value="<?= htmlspecialchars($data['pokemon']['id']) ?>" class="input input-bordered" disabled />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Nombre del Pokemon</span>
                            </label>
                            <input type="text" name="name" value="<?= htmlspecialchars($data['pokemon']['name']) ?>" class="input input-bordered" required autofocus />
                        </div>
                        
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Tipo</span>
                            </label>
                            <select name="type" class="select select-bordered" required>
                                <option disabled>Selecciona un tipo</option>
                                <option value="Water" <?= $data['pokemon']['type'] == 'Water' ? 'selected' : '' ?>>💧 Water</option>
                                <option value="Grass" <?= $data['pokemon']['type'] == 'Grass' ? 'selected' : '' ?>>🌿 Grass</option>
                                <option value="Fire" <?= $data['pokemon']['type'] == 'Fire' ? 'selected' : '' ?>>🔥 Fire</option>
                                <option value="Electric" <?= $data['pokemon']['type'] == 'Electric' ? 'selected' : '' ?>>⚡ Electric</option>
                                <option value="Normal" <?= $data['pokemon']['type'] == 'Normal' ? 'selected' : '' ?>>⭐ Normal</option>
                                <option value="Poison" <?= $data['pokemon']['type'] == 'Poison' ? 'selected' : '' ?>>☠️ Poison</option>
                                <option value="Ghost" <?= $data['pokemon']['type'] == 'Ghost' ? 'selected' : '' ?>>👻 Ghost</option>
                                <option value="Dragon" <?= $data['pokemon']['type'] == 'Dragon' ? 'selected' : '' ?>>🐉 Dragon</option>
                                <option value="Rock" <?= $data['pokemon']['type'] == 'Rock' ? 'selected' : '' ?>>🪨 Rock</option>
                                <option value="Fighting" <?= $data['pokemon']['type'] == 'Fighting' ? 'selected' : '' ?>>🥊 Fighting</option>
                                <option value="Psychic" <?= $data['pokemon']['type'] == 'Psychic' ? 'selected' : '' ?>>🔮 Psychic</option>
                                <option value="Ice" <?= $data['pokemon']['type'] == 'Ice' ? 'selected' : '' ?>>❄️ Ice</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Entrenador</span>
                            </label>
                            <select name="trainer_id" class="select select-bordered">
                                <option value="">Sin entrenador</option>
                                <?php foreach($data['trainers'] as $trainer): ?>
                                    <option value="<?= $trainer['id'] ?>" <?= $data['pokemon']['trainer_id'] == $trainer['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($trainer['name']) ?> (Lvl <?= $trainer['level'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="divider">Estadísticas</div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">⚔️ Strength</span>
                            </label>
                            <input type="number" name="strength" value="<?= htmlspecialchars($data['pokemon']['strength']) ?>" min="1" max="1500" class="input input-bordered" required />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">❤️ Stamina</span>
                            </label>
                            <input type="number" name="staming" value="<?= htmlspecialchars($data['pokemon']['staming']) ?>" min="1" max="500" class="input input-bordered" required />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">⚡ Speed</span>
                            </label>
                            <input type="number" name="speed" value="<?= htmlspecialchars($data['pokemon']['speed']) ?>" min="1" max="200" class="input input-bordered" required />
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">🎯 Accuracy</span>
                            </label>
                            <input type="number" name="accuracy" value="<?= htmlspecialchars($data['pokemon']['accuracy']) ?>" min="1" max="250" class="input input-bordered" required />
                        </div>
                    </div>

                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M227.32,73.37,182.63,28.69a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31l83.67-83.66,3.48,13.9-36.8,36.79a8,8,0,0,0,11.31,11.32l40-40a8,8,0,0,0,2.11-7.6l-6.9-27.61L227.32,96A16,16,0,0,0,227.32,73.37ZM48,179.31,76.69,208H48Zm48,25.38L51.31,160,136,75.31,180.69,120Zm96-96L147.32,64l24-24L216,84.69Z"></path>
                            </svg>
                            Actualizar Pokemon
                        </button>
                    </div>
                    <div class="form-control">
                        <a href="<?= $data['url'] ?>" class="btn btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path>
                            </svg>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>