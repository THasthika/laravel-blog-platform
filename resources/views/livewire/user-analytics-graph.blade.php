<div>
    <div class="p-4">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-lg">{{__("Analytics")}}</div>
            </div>
            <div class="form-control max-w-xs">
                <label class="label" for="view-range">{{__("View Range")}}</label>
                <select class="select select-bordered" id="view-range" wire:model="selectedViewRange">
                    @foreach($viewRanges as $k => $v)
                        <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <canvas class="max-h-64" id="user-analytics-chart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        function setupChart() {
            const ctx = document.getElementById('user-analytics-chart');

            const labels = @this.labels;
            const values = @this.values;

            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Views',
                        data: values['views'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            ticks: {
                                // forces step size to be 50 units
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            return chart;
        }

        document.addEventListener('livewire:load', () => {
            const chart = setupChart();
            @this.on('view-range-changed', () => {
                const labels = @this.labels;
                const values = @this.values;
                chart.data.labels = labels;
                chart.data.datasets[0].data = values['views'];
                chart.update();
            });
        });
    </script>
</div>
