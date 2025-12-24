<h2>New User Registration</h2>
<p>A new user has registered:</p>
<p>
    <strong>Name:</strong> {{ $user->name }}<br />
    <strong>Email:</strong> {{ $user->email }}<br />
    <strong>Date:</strong> {{ $user->created_at->format('F j, Y') }}
</p>