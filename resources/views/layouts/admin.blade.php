<div id="hardwareModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-surface-container rounded-xl border border-outline-variant w-full max-w-lg p-6 premium-shadow relative">
            
            <div class="flex justify-between items-center mb-6 border-b border-outline-variant pb-3">
                <h3 class="font-headline-lg text-xl font-bold text-white flex items-center gap-2">
                    <span class="material-symbols-outlined">add_box</span> Tambah Katalog Hardware
                </h3>
                <button onclick="toggleModal()" class="text-on-surface-variant hover:text-white transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form action="{{ route('admin.hardware.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-label-tech text-xs text-on-surface-variant uppercase mb-1">Nama Komponen</label>
                    <input type="text" name="name" required class="w-full bg-background border border-outline-variant rounded-lg px-3 py-2 text-sm text-white focus:border-white focus:outline-none" placeholder="Contoh: AMD Ryzen 5 7600X">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-tech text-xs text-on-surface-variant uppercase mb-1">Kategori</label>
                        <select name="category" required class="w-full bg-background border border-outline-variant rounded-lg px-3 py-2 text-sm text-white focus:border-white focus:outline-none">
                            <option value="PROCESSORS">PROCESSORS</option>
                            <option value="GRAPHICS_CARDS">GRAPHICS CARDS</option>
                            <option value="MEMORY">MEMORY (RAM)</option>
                            <option value="STORAGE">STORAGE (SSD/HDD)</option>
                            <option value="MOTHERBOARDS">MOTHERBOARDS</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-label-tech text-xs text-on-surface-variant uppercase mb-1">Konsumsi Daya (Watt)</label>
                        <input type="number" name="wattage" required class="w-full bg-background border border-outline-variant rounded-lg px-3 py-2 text-sm text-white focus:border-white focus:outline-none" placeholder="65">
                    </div>
                </div>

                <div>
                    <label class="block font-label-tech text-xs text-on-surface-variant uppercase mb-1">Harga (Rupiah)</label>
                    <input type="number" name="price" required class="w-full bg-background border border-outline-variant rounded-lg px-3 py-2 text-sm text-white focus:border-white focus:outline-none" placeholder="3500000">
                </div>

                <div class="border-t border-outline-variant/50 pt-3">
                    <p class="text-xs font-label-tech text-white uppercase tracking-wider mb-2">Atribut Spesifikasi Teknis (Optional)</p>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="text" name="socket" class="bg-background border border-outline-variant rounded-lg px-3 py-1.5 text-xs text-white focus:outline-none" placeholder="Socket (e.g., AM5, LGA1700)">
                        <input type="text" name="chipset" class="bg-background border border-outline-variant rounded-lg px-3 py-1.5 text-xs text-white focus:outline-none" placeholder="Chipset (e.g., B650, Z790)">
                        <input type="text" name="ram_type" class="bg-background border border-outline-variant rounded-lg px-3 py-1.5 text-xs text-white focus:outline-none" placeholder="Tipe RAM (e.g., DDR5, DDR4)">
                        <input type="text" name="capacity" class="bg-background border border-outline-variant rounded-lg px-3 py-1.5 text-xs text-white focus:outline-none" placeholder="Kapasitas (e.g., 16GB, 1TB)">
                    </div>
                </div>

                <div class="flex gap-3 pt-4 border-t border-outline-variant">
                    <button type="button" onclick="toggleModal()" class="flex-1 bg-surface-container-highest hover:bg-surface-variant text-white font-bold py-2 rounded-lg text-sm transition-colors border border-outline-variant">Batal</button>
                    <button type="submit" class="flex-1 bg-white hover:bg-slate-200 text-black font-bold py-2 rounded-lg text-sm transition-colors shadow-md">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('hardwareModal');
            modal.classList.toggle('hidden');
        }
        
        // Daftarkan fungsi klik ke tombol "Tambah Hardware Baru" di atas
        document.querySelector('button[class*="bg-white hover:bg-slate-200"]').setAttribute('onclick', 'toggleModal()');
    </script>