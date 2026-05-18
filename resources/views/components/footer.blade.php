<footer class="w-full h-20 shrink-0 bg-canvas border-t border-hairline shadow-[0_-4px_24px_rgba(0,0,0,0.02)] relative z-20">
    <div class="flex justify-between items-center px-8 py-2 h-full">
        <div class="flex items-center gap-6 flex-1">
            <div class="relative">
                <div class="w-10 h-10 rounded-[6px] bg-canvas-soft border border-hairline flex items-center justify-center text-ink">
                    <span class="material-symbols-outlined text-[20px]">psychology</span>
                </div>
                <div class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-primary rounded-full border-2 border-canvas"></div>
            </div>
            <div>
                <h5 class="text-ink font-medium text-[12px] tracking-widest uppercase">Hardware Guru AI</h5>
                <p class="text-ink-mute text-[13px] mt-0.5">
                    <span class="font-medium text-ink">Sistem Siap.</span> Tambahkan komponen untuk memulai analisis kompatibilitas dan deteksi bottleneck.
                </p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            
            @if(isset($currentRig) && $currentRig->components->count() > 0)
                <a href="{{ route('compatibility.index', $currentRig->id) }}" class="bg-primary text-on-primary px-[16px] py-[8px] rounded-[6px] font-medium text-[14px] hover:bg-primary-deep transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">analytics</span>
                    Analisis Rakitan
                </a>
            @else
                <button disabled class="bg-canvas-soft text-ink-mute border border-hairline px-[16px] py-[8px] rounded-[6px] font-medium text-[14px] cursor-not-allowed flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">lock</span>
                    Pilih Hardware
                </button>
            @endif

        </div>
    </div>
</footer>