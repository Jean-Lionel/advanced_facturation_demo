<div class="d-flex justify-content-around noprint mt-2">
    <div>
        <a href="{{ route('employee.index') }}" class="{{ setActiveRoute('employee.index') }}"><span class="fa fa-user"></span> Employées</a>
    </div>

    <div>
        <a href="{{ route('leave.index') }}" class="{{ setActiveRoute('leave.index') }}"><span class="fa fa-plane"></span> Congé</a>
    </div>

    <div>
        <a href="{{ route('retenue.index') }}" class="{{ setActiveRoute('retenue.index') }}"><span class="fa fa-minus-circle"></span> Déduction</a>
    </div>

    <div>
        <div class="dropdown show">
            <a class="{{ setActiveRoute('payslip.index') }} dropdown-toggle" href="#" role="button" id="dropdownMenuSalary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="fa fa-university"></span> Salaire
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuSalary">
                <a class="{{ setActiveRoute('payslip.index') }} dropdown-item" href="{{ route('payslip.index') }}">Fiche de Paie</a>
                <a class="{{ setActiveRoute('payslip.reportSalary') }} dropdown-item" href="{{ route('payslip.reportSalary') }}">Rapport Salaire</a>
                <a class="{{ setActiveRoute('payslip.reportIpr') }} dropdown-item" href="{{ route('payslip.reportIpr') }}">Rapport IPR</a>
                <a class="{{ setActiveRoute('payslip.reportInss') }} dropdown-item" href="{{ route('payslip.reportInss') }}">Rapport INSS</a>
            </div>
        </div>
    </div>

    <div>
        <div class="dropdown show">
            <a class="{{ setActiveRoute('bank.index') }} dropdown-toggle" href="#" role="button" id="dropdownMenuParam" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="fa fa-cog"></span> Parametre
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuParam">
                <a class="{{ setActiveRoute('bank.index') }} dropdown-item" href="{{ route('bank.index') }}">Banque</a>
                <a class="{{ setActiveRoute('indeminity.index') }} dropdown-item" href="{{ route('indeminity.index') }}">Indeminités</a>
                <a class="{{ setActiveRoute('typeRetenue.index') }} dropdown-item" href="{{ route('typeRetenue.index') }}">Type de déductions</a>
                <a class="{{ setActiveRoute('typeLeave.index') }} dropdown-item" href="{{ route('typeLeave.index') }}">Catégorie de congé</a>
                <a class="{{ setActiveRoute('departement.index') }} dropdown-item" href="{{ route('departement.index') }}">Type de département</a>
                <a class="{{ setActiveRoute('poste.index') }} dropdown-item" href="{{ route('poste.index') }}">Type de Poste</a>
            </div>
        </div>
    </div>
</div>
<hr>
