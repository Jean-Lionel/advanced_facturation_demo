@csrf

<div class="app-card-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Nom</label>
                <input
                    required
                    type="text"
                    class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name ?? '') }}"
                >
                {!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input
                    required
                    type="email"
                    class="form-control form-control-sm {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email ?? '') }}"
                >
                {!! $errors->first('email', '<small class="help-block invalid-feedback">:message</small>') !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input
                    type="password"
                    class="form-control form-control-sm {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    id="password"
                    name="password"
                    value=""
                    @if (!isset($user) || !$user->id) required @endif
                    placeholder="{{ isset($user) && $user->id ? 'Laisser vide pour ne pas changer' : '' }}"
                >
                {!! $errors->first('password', '<small class="help-block invalid-feedback">:message</small>') !!}
            </div>
        </div>
    </div>

    @if (!empty($roles))
        <div class="app-roles mt-3">
            <div class="app-roles-header">
                <p class="app-roles-title">Rôles</p>
            </div>
            <div class="app-roles-grid">
                @foreach ($roles as $role)
                    @php
                        $isChecked = isset($user) && $user->roles->contains('id', $role->id);
                    @endphp
                    <label class="app-role-option {{ $isChecked ? 'is-checked' : '' }}" for="role_{{ $role->id }}">
                        <input
                            type="checkbox"
                            name="roles[]"
                            value="{{ $role->id }}"
                            id="role_{{ $role->id }}"
                            @if ($isChecked) checked @endif
                            onchange="this.closest('.app-role-option').classList.toggle('is-checked', this.checked)"
                        >
                        <span class="app-role-check" aria-hidden="true"></span>
                        <span class="app-role-name">{{ $role->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    @endif

    <div class="app-form-actions mt-3">
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">Annuler</a>
        <button type="submit" class="btn btn-primary btn-sm">
            {{ $btnMessage ?? 'Enregistrer' }}
        </button>
    </div>
</div>
