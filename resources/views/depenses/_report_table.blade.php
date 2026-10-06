<table class="report-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Action</th>
            <th>Catégorie</th>
            <th>Montant (FBu)</th>
            <th>Description</th>
            <th>Enregistré par</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($depenses as $index => $depense)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $depense->date_depense ? $depense->date_depense->format('d/m/Y') : $depense->created_at->format('d/m/Y') }}</td>
                <td>{{ $depense->name }}</td>
                <td>{{ $depense->category->name ?? '-' }}</td>
                <td class="text-right">{{ number_format($depense->montant, 2, ',', ' ') }}</td>
                <td>{{ $depense->description }}</td>
                <td>{{ $depense->user->name ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Aucune dépense pour cette période.</td>
            </tr>
        @endforelse
    </tbody>
    @if ($depenses->isNotEmpty())
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total</th>
                <th class="text-right">{{ number_format($totalMontant, 2, ',', ' ') }} FBu</th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
    @endif
</table>