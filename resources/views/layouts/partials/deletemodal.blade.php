<!-- Modal Overlay and Content -->
<div id="dialog" class="fixed left-0 top-0 bg-black bg-opacity-50 hidden w-screen h-screen transition-opacity duration-500 flex justify-center items-center z-10 " onclick="hideDialog()">
    <div class="bg-white  rounded shadow-md p-8 mx-auto my-20 w-1/4 min-w-72" onclick="event.stopPropagation()">
        <div class="flex items-center gap-5">
            <div class="bg-red-200 rounded-full text-red-800 flex items-center justify-center w-10 h-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>
            <div>
                <h1 class="font-bold text-lg mb-2">Delete "<span id="modal-title"></span>"</h1>
                <p>This action cannot be undone.</p>
            </div>
        </div>
        <div class="flex justify-end mt-5">
            <form id="modal-delete-form" method="POST" class="flex justify-between gap-2">
                @csrf
                @method('delete')
                <button type="button" class="bg-gray-100 border border-gray-300 px-6 py-2 rounded text-black hover:bg-gray-200 flex items-center gap-2" onclick="hideDialog()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>     
                    Cancel
                    </button>
                <button type="submit" class="bg-red-500 px-6 py-2 rounded text-white hover:bg-red-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                      </svg>                      
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
   function showDialog(title, deleteUrl) {
    // Seleccionar los elementos del modal
    const dialog = document.getElementById('dialog');
    const modalTitle = document.getElementById('modal-title');
    const modalDeleteForm = document.getElementById('modal-delete-form');

    // Actualizar el contenido dinámico del modal
    modalTitle.textContent = title;
    modalDeleteForm.action = deleteUrl;

    // Mostrar el modal
    dialog.classList.remove('hidden');
    setTimeout(() => {
        dialog.classList.remove('opacity-0');
    }, 20);
}
function hideDialog() {
        let dialog = document.getElementById('dialog');
        dialog.classList.add('opacity-0');
        setTimeout(() => {
            dialog.classList.add('hidden');
        }, 500);
    }
</script>