<div class="d-flex justify-content-around noprint mt-2">
    <div>
        <a href="{{ route('employee.index') }}" class="{{ setActiveRoute('employee.index') }}"><span class="fa fa-user"></span> Employées</a>
    </div>

    <div>
        <a href="{{ route('leave.index') }}" class="{{ setActiveRoute('leave.index') }}"><span class="fa fa-user"></span> Congé</a>
    </div>

    <div>
        <a href="{{ route('retenue.index') }}" class="{{ setActiveRoute('retenue.index') }}"><span class="fa fa-user"></span> Déduction</a>
    </div>

    <div>
        <a href="{{ route('payslip.index') }}" class="{{ setActiveRoute('payslip.index') }}"><span class="fa fa-user"></span> Salaire</a>
    </div>
</div>
<hr>
