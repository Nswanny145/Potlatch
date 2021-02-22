<h1>Account</h1>
<hr>
<h2>Information</h2>
<?= form_open('account/edit', ['class' => 'card-body']) ?>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" size="50" placeholder="<?= $user->first_name ?>"/>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" size="50" placeholder="<?= $user->last_name ?>" />
    </div>
    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="text" class="form-control" id="email" name="email" size="50" placeholder="<?= $user->email ?>"/>
    </div>
    <button type="submit" class="btn btn-block btn-primary">Save edits</button>
</form>