<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles - <?= htmlspecialchars($data['pokemon']['name']) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-base-200">

    <!-- NAVBAR -->
    <div class="navbar bg-base-100 shadow-lg px-6">
        <div class="flex-1">
            <span class="text-xl font-bold">👁️ Detalle del Pokémon</span>
        </div>
        <div class="flex-none">
            <a href="<?= $data['url'] ?>" class="btn btn-ghost btn-sm">
                Volver
            </a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="container mx-auto p-6 flex justify-center">

        <div class="card bg-base-100 w-full max-w-2xl shadow-xl">
            <div class="card-body">

                <!-- HEADER -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold">
                        <?= htmlspecialchars($data['pokemon']['name']) ?>
                    </h1>
                    <p class="text-base-content/70">
                        Información completa del Pokémon
                    </p>
                </div>

                <!-- BASIC INFO -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <span class="font-semibold text-sm text-base-content/60">ID</span>
                        <p class="text-lg font-bold">
                            #<?= htmlspecialchars($data['pokemon']['id']) ?>
                        </p>
                    </div>

                    <div>
                        <span class="font-semibold text-sm text-base-content/60">Nombre</span>
                        <p class="text-lg font-bold">
                            <?= htmlspecialchars($data['pokemon']['name']) ?>
                        </p>
                    </div>

                    <div>
                        <span class="font-semibold text-sm text-base-content/60">Tipo</span>
                        <div class="mt-1">
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

                            $typeEmojis = [
                                'Water' => '💧',
                                'Grass' => '🌿',
                                'Fire' => '🔥',
                                'Electric' => '⚡',
                                'Normal' => '⭐',
                                'Poison' => '☠️',
                                'Ghost' => '👻',
                                'Dragon' => '🐉',
                                'Rock' => '🪨'
                            ];

                            $badgeClass = $typeColors[$data['pokemon']['type']] ?? 'badge-ghost';
                            $emoji = $typeEmojis[$data['pokemon']['type']] ?? '❓';
                            ?>
                            <span class="badge <?= $badgeClass ?> badge-lg">
                                <?= $emoji ?> <?= htmlspecialchars($data['pokemon']['type']) ?>
                            </span>
                        </div>
                    </div>

                    <div>
                        <span class="font-semibold text-sm text-base-content/60">Entrenador</span>
                        <div class="mt-1">
                            <?php if ($data['pokemon']['trainer_name']): ?>
                                <span class="badge badge-outline badge-lg">
                                    <?= htmlspecialchars($data['pokemon']['trainer_name']) ?>
                                </span>
                                <p class="text-xs text-base-content/60 mt-1">
                                    Nivel <?= htmlspecialchars($data['pokemon']['trainer_level']) ?>
                                </p>
                            <?php else: ?>
                                <span class="italic text-base-content/50">
                                    Sin entrenador
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <div class="divider font-semibold">Estadísticas</div>

                <!-- STATS -->
                <div class="space-y-4">

                    <div>
                        <div class="flex justify-between text-sm font-semibold mb-1">
                            <span>⚔️ Strength</span>
                            <span><?= htmlspecialchars($data['pokemon']['strength']) ?>/1500</span>
                        </div>
                        <progress class="progress progress-error w-full"
                                  value="<?= htmlspecialchars($data['pokemon']['strength']) ?>" max="1500"></progress>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm font-semibold mb-1">
                            <span>❤️ Stamina</span>
                            <span><?= htmlspecialchars($data['pokemon']['staming']) ?>/320</span>
                        </div>
                        <progress class="progress progress-success w-full"
                                  value="<?= htmlspecialchars($data['pokemon']['staming']) ?>" max="320"></progress>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm font-semibold mb-1">
                            <span>⚡ Speed</span>
                            <span><?= htmlspecialchars($data['pokemon']['speed']) ?>/120</span>
                        </div>
                        <progress class="progress progress-warning w-full"
                                  value="<?= htmlspecialchars($data['pokemon']['speed']) ?>" max="120"></progress>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm font-semibold mb-1">
                            <span>🎯 Accuracy</span>
                            <span><?= htmlspecialchars($data['pokemon']['accuracy']) ?>/232</span>
                        </div>
                        <progress class="progress progress-info w-full"
                                  value="<?= htmlspecialchars($data['pokemon']['accuracy']) ?>" max="232"></progress>
                    </div>

                </div>

                <div class="divider"></div>

                <!-- ACTIONS -->
                <div class="flex flex-col md:flex-row gap-3">

                    <a href="<?= $data['url'] ?>edit/<?= $data['pokemon']['id'] ?>"
                       class="btn btn-warning flex-1 gap-2">
                        ✏️ Editar
                    </a>

                    <a href="<?= $data['url'] ?>delete/<?= $data['pokemon']['id'] ?>"
                       class="btn btn-error flex-1 gap-2">
                        🗑️ Eliminar
                    </a>

                </div>

                <a href="<?= $data['url'] ?>" class="btn btn-ghost mt-4">
                    ⬅️ Volver a la lista
                </a>

            </div>
        </div>

    </div>

</body>
</html>
