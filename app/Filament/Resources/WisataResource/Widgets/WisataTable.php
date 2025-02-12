<?php

namespace App\Filament\Resources\WisataResource\Widgets;

use App\Models\Wisata;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class WisataTable extends BaseWidget
{
    protected int | string | array $columnSpan = 'full'; // Buat tabel lebar penuh

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(Wisata::query()->where('id_jenis', 4)) // Ambil data terbaru
            ->columns([
                TextColumn::make('nama')->label('Nama Wisata')->searchable(),
                TextColumn::make('lokasi')->label('Lokasi'),
                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ]);
        // ->defaultPagination(5);
    }
}
