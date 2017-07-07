<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
	
		
		DB::table('users')->delete();
		
		User::create(array(
                        'email' => 'powermate1@gmail.com',
                        'displayname' => 'Muhi Máté',
                        'type' => '1',
                        'password' => Hash::make('12345678'),
                        'created_at' => '2017-06-26 07:18:23',
                ));
                User::create(array(
                        'email' => 'laci.aszti@gmail.com',
                        'displayname' => 'Aszti Laci',
                        'type' => '1',
                        'password' => Hash::make('12345678'),
                        'created_at' => '2017-06-27 03:38:46',
                ));
		User::create(array(
			'email' => 'gotti@lacosanostra.hu',
			'displayname' => 'Gotti János',
			'type' => '2',
			'password' => Hash::make('bonyolult123'),
			'created_at' => '2017-06-26 07:18:23',
		));
		User::create(array(
                        'email' => 'futaki@paraszintezis.hu',
                        'displayname' => 'Futaki Bátor',
                        'type' => '0',
                        'password' => Hash::make('ezittajelszo'),
			'created_at' => '2017-06-27 03:38:46',
                ));
		
	}

}
