<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon MVC</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-base-200">

    <!-- NAVBAR -->
    <div class="navbar bg-base-100 shadow-lg px-6">
        <div class="flex-1">
            <span class="text-xl font-bold">⚡ Pokemon MVC</span>
        </div>
        <div class="flex-none">
            <a href="<?= $data['url'] ?>add" class="btn btn-success btn-sm gap-2">
                ➕ Add Pokemon
            </a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="container mx-auto p-6">

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">

                <div class="text-center mb-6">
                    <h1 class="text-4xl font-bold">Pokémon List</h1>
                    <p class="text-base-content/70">Model · View · Controller</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-zebra table-lg">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Trainer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach($data['pokemons'] as $pokemon): ?>
                            <tr class="text-center align-middle">
                                <td class="font-bold"><?= htmlspecialchars($pokemon['id']) ?></td>

                                <td><?= htmlspecialchars($pokemon['name']) ?></td>

                                <td>
                                    <?php 
                                    $typeColors = [
                                        'Water' => 'badge-info',
                                        'Grass' => 'badge-success',
                                        'Fire' => 'badge-error',
                                        'Electric' => 'badge-warning',
                                        'Normal' => 'badge-secondary',
                                        'Poison' => 'badge-primary',
                                        'Ghost' => 'badge-accent',
                                        'Dragon' => 'badge-secondary',
                                        'Rock' => 'badge-neutral'
                                    ];
                                    $badgeClass = $typeColors[$pokemon['type']] ?? 'badge-ghost';
                                    ?>
                                    <span class="badge <?= $badgeClass ?> badge-lg">
                                        <?= htmlspecialchars($pokemon['type']) ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if ($pokemon['trainer_name']): ?>
                                        <span class="badge badge-outline badge-lg">
                                            <?= htmlspecialchars($pokemon['trainer_name']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-base-content/50 italic">
                                            Sin entrenador
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="space-x-1">

                                    <a href="<?= $data['url'] ?>show/<?= $pokemon['id'] ?>" 
                                       class="btn btn-info btn-xs tooltip" data-tip="Ver">
                                        🔍
                                    </a>

                                    <a href="<?= $data['url'] ?>edit/<?= $pokemon['id'] ?>" 
                                       class="btn btn-warning btn-xs tooltip" data-tip="Editar">
                                        ✏️
                                    </a>

                                    <a href="<?= $data['url'] ?>delete/<?= $pokemon['id'] ?>" 
                                       class="btn btn-error btn-xs tooltip" data-tip="Eliminar">
                                        🗑️
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- ALERT -->
    <?php if (isset($_SESSION['message'])): ?>
    <script>
        Swal.fire({
            icon: '<?= $_SESSION['message_type'] ?>',
            title: '<?= $_SESSION['message_type'] === 'success' ? '¡Éxito!' : '¡Atención!' ?>',
            text: '<?= $_SESSION['message'] ?>',
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn-success'
            },
            buttonsStyling: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
    <?php 
        unset($_SESSION['message'], $_SESSION['message_type']);
    endif; 
    ?>

</body>
</html>
