<div x-data="{
    secondsToCountdown: {{ $seconds }}, // Initial time in seconds
    seconds: 0,
    timer: null,
    isFinished: false,

    init() {
        this.seconds = this.secondsToCountdown;

        if (this.seconds < 0) {
            this.isFinished = true;
        } else {
            this.startTimer();
        }
    },

    startTimer() {
        this.timer = setInterval(() => {
            if (this.seconds > 0) {
                this.seconds--;
            } else {
                this.stopTimer();
                this.isFinished = true;
            }
        }, 1000); // Update every second
    },

    stopTimer() {
        clearInterval(this.timer);
        this.timer = null;
    },

    formatTime(time) {
        const hours = Math.floor(time / 3600);
        const minutes = Math.floor((time % 3600) / 60);
        const seconds = time % 60;
        return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
}" x-cloak>
    <template x-if="!isFinished">
        <p>{{ $timeRemainingLabel ?? 'Time remaining:' }} <span x-text="formatTime(seconds)"></span></p>
    </template>
    <template x-if="isFinished">
        <p>{{ $finishedText ?? 'Countdown Finished' }}</p>
    </template>
</div>

{{-- NOTE: If you've published this component and would prefer to use alpine as a module, remove this line and implement it in your project as directed here: https://alpinejs.dev/essentials/installation#as-a-module --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.2/dist/cdn.min.js"></script>
