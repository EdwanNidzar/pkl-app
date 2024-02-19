@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | EDIT PROFILE')

@section('content')
  <section class="content">
    <div class="container">
      <div class="row justify-content-center align-items-center"> <!-- Add align-items-center class -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Edit Profile</div>
            <div class="card-body">
              <!-- Display user's information -->
              <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <!-- Display user's profile fields -->
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $user->name) }}">
                </div>

                <!-- Display panwascam fields -->
                <div class="form-group">
                  <label for="fullname">Full Name</label>
                  <input type="text" name="fullname" id="fullname" class="form-control"
                    value="{{ old('fullname', $user->panwascam->fullname ?? '') }}">
                </div>

                <div class="form-group">
                  <label for="alamat">Address</label>
                  <input type="text" name="alamat" id="alamat" class="form-control"
                    value="{{ old('alamat', $user->panwascam->alamat ?? '') }}">
                </div>

                <div class="form-group">
                  <label for="gender">Gender</label>
                  <select name="gender" id="gender" class="form-control">
                    <option selected disabled>Choose</option>
                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female
                    </option>
                  </select>

                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
@endsection
