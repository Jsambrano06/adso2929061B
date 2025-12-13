<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Pokemon</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col">
            <div class="text-center mb-4">
                <h1 class="text-5xl font-bold text-error">Eliminar Pokemon</h1>
                <p class="py-2">Confirma la eliminación del siguiente Pokemon</p>
            </div>
            <div class="card bg-base-100 w-full max-w-sm shadow-2xl">
                <div class="card-body">
                    <div class="space-y-4">
                        <div>
                            <label class="label">
                                <span class="label-text font-bold">ID:</span>
                            </label>
                            <div class="text-lg"><?= htmlspecialchars($data['pokemon']['id']) ?></div>
                        </div>
                        
                        <div>
                            <label class="label">
                                <span class="label-text font-bold">Nombre:</span>
                            </label>
                            <div class="text-lg font-bold"><?= htmlspecialchars($data['pokemon']['name']) ?></div>
                        </div>
                        
                        <div>
                            <label class="label">
                                <span class="label-text font-bold">Tipo:</span>
                            </label>
                            <div>
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
                                $badgeClass = $typeColors[$data['pokemon']['type']] ?? 'badge-ghost';
                                
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
                                $emoji = $typeEmojis[$data['pokemon']['type']] ?? '❓';
                                ?>
                                <span class="badge <?= $badgeClass ?> badge-lg">
                                    <?= $emoji ?> <?= htmlspecialchars($data['pokemon']['type']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <form id="deleteForm" method="POST" action="<?= $data['url'] ?>destroy/<?= $data['pokemon']['id'] ?>">
                        <div class="card-actions justify-center flex-col gap-2">
                            <button type="button" onclick="confirmDelete()" class="btn btn-error w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                                </svg>
                                Eliminar Pokemon
                            </button>
                            
                            <a href="<?= $data['url'] ?>" class="btn btn-ghost w-full">
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
    </div>

    <script>
        function confirmDelete() {
            Swal.fire({
                title: '¿Estás seguro?',
                html: '<p class="text-lg">Vas a eliminar a <strong><?= htmlspecialchars($data['pokemon']['name']) ?></strong></p><p class="text-sm text-gray-500 mt-2">Esta acción no se puede deshacer</p>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-lg',
                    confirmButton: 'btn btn-error',
                    cancelButton: 'btn btn-ghost'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar loading
                    Swal.fire({
                        title: 'Eliminando...',
                        text: 'Por favor espera',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Enviar el formulario
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script>
</body>
</html>