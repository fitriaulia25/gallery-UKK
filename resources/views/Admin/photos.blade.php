@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">📸 Statistik Foto per Bulan</h4>
            <div class="p-3">
                <canvas id="photoChart" style="max-height: 500px; height: 400px;"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('photoChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!},  
            datasets: [{
                label: 'Jumlah Foto',  
                data: {!! json_encode($photoCounts) !!}, 
                borderColor: '#9b59b6', 
                backgroundColor: 'rgba(155, 89, 182, 0.2)',
                pointBackgroundColor: '#9b59b6',
                fill: true,
                tension: 0.4, 
                borderWidth: 2,  
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Foto'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Grafik Jumlah Foto per Bulan',
                    font: {
                        size: 18  
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#333'
                    }
                }
            }
        }
    });
</script>
@endsection
