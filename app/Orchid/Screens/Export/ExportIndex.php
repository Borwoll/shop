<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Export;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\DropDown;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportIndex extends Screen {
    public function query(): iterable {
        return [];
    }

    public function name(): ?string {
        return 'Экспорт БД';
    }

    public function permission(): ?iterable {
        return [
            'platform.systems.export',
        ];
    }

    public function commandBar(): iterable {
        return [
            DropDown::make('Выгрузка БД')
                ->icon('cloud-download')
                ->list([
                    Button::make('CSV')
                        ->method('export_csv')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('XLSX')
                        ->method('export_xlxs')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('TSV')
                        ->method('export_tsv')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('ODS')
                        ->method('export_ods')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('XLS')
                        ->method('export_xls')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('HTML')
                        ->method('export_html')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('MPDF')
                        ->method('export_MPDF')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('DOMPDF')
                        ->method('export_DOMPDF')
                        ->rawClick()
                        ->novalidate(),

                    Button::make('TCPDF')
                        ->method('export_TCPDF')
                        ->rawClick()
                        ->novalidate(),
                ]),

        ];
    }

    public function layout(): iterable {
        return [];
    }

    public function export_csv() {
        return Excel::download(new UsersExport, 'shop_bd.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function export_xlxs() {
        return Excel::download(new UsersExport, 'shop_bd.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function export_tsv() {
        return Excel::download(new UsersExport, 'shop_bd.tsv', \Maatwebsite\Excel\Excel::TSV);
    }

    public function export_ods() {
        return Excel::download(new UsersExport, 'shop_bd.ods', \Maatwebsite\Excel\Excel::ODS);
    }

    public function export_xls() {
        return Excel::download(new UsersExport, 'shop_bd.xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function export_html() {
        return Excel::download(new UsersExport, 'shop_bd.html', \Maatwebsite\Excel\Excel::HTML);
    }

    public function export_MPDF() {
        return Excel::download(new UsersExport, 'shop_bd.mpdf', \Maatwebsite\Excel\Excel::MPDF);
    }

    public function export_DOMPDF() {
        return Excel::download(new UsersExport, 'shop_bd.dompdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function export_TCPDF() {
        return Excel::download(new UsersExport, 'shop_bd.tcpdf', \Maatwebsite\Excel\Excel::TCPDF);
    }
}
