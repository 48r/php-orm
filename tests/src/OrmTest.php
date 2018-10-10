<?php

  use PHPUnit\Framework\TestCase;

  final class OrmTest extends TestCase {

      public function setUp() {
        (new Orm())
          ->create()
          ->database('orm_test')
          ->exec();

        (new Orm(['database' => 'orm_test']))
          ->create()
          ->table('user')
          ->columns(
            ['id', 'int', 20, 'primary'],
            ['name', 'varchar', 255]
          )
          ->exec();
          Orm::query("INSERT INTO user (id, name) VALUES(1, 'Test 1')");
          Orm::query("INSERT INTO user (id, name) VALUES(2, 'Test 2')");
      }

      public function tearDown() {
        (new Orm())
          ->drop()
          ->database('orm_test')
          ->exec();
      }
      
      public function testConstruct() {
        $this->assertInstanceOf(Orm::class, new Orm());
      }

      public function testConstructWrongCredentials($config=[]) {
        $this->expectException(OrmConnectionException::class);
        new Orm([
          'username' => 'non-existing-user',
          'password' => 'wrong-password'
        ]);
      }

      public function testConstructNonExistingDatabase() {
        $this->expectException(OrmConnectionException::class);
        new Orm([
          'database' => 'non-existing-database'
        ]);
      }

      public function testSet() {
        $o = new Orm();
        $o->name = 'value';

        $this->assertAttributeEquals([
          'name' => 'value'
        ], 'values', $o);
      }

      public function testGet() {
        $o = new Orm();
        $o->name = 'value';

        $this->assertEquals($o->name, 'value');
      }

      public function testCall() {
        $o = new Orm();
        $o->select('value');

        $this->assertAttributeEquals([
          'select' => ['value']
        ], 'components', $o);
      }

      public function testBuild() {
        $r = (new Orm())
          ->select('name')
          ->from('user')
          ->build();

        $this->assertEquals(
          $r,
          'SELECT name FROM `user`'
        );
      }

      public function testBuildUnknownComponent() {
        $this->expectException(OrmBuilderComponentNotImplementedException::class);
        (new Orm())
          ->nonExistingComponent('name')
          ->build();
      }

      public function testQuery() {
        $r = Orm::query('SELECT * FROM user WHERE id = :id LIMIT 1', [
          'id' => 1
        ]);
        $this->assertTrue(is_array($r));
        $this->assertCount(1, $r);
      }
      
      public function testExec() {
        $r = (new Orm())
          ->exec(
            'SELECT * FROM user WHERE id = :id LIMIT 1',
            ['id' => 1]
          );
        $this->assertTrue(is_array($r));
        $this->assertCount(1, $r);
      }

      public function testFind() {
        $r = (new Orm())->from('user')->find();
        $this->assertTrue(is_array($r));
        $this->assertCount(2, $r);
      }
      
      public function testFindOne() {
        $r = (new Orm())->from('user')->findOne();
        $this->assertInstanceOf(User::class, $r);
      }

      public function testSaveUpdate() {
        $u = new User();
        $u->id = 1;
        $u->name = 'Name changed';
        $u->save();

        $r = (new Orm())
          ->from('user')
          ->where([
            'id' => $u->id
          ])
          ->findOne();

        $this->assertEquals(
          $u->name,
          $r->name
        );
      }

      public function testSaveUpdateFailedSoSkipToInsert() {
        $u = new User();
        $u->id = 3;
        $u->name = 'Test 3';
        $u->save();

        $r = (new Orm())
          ->from('user')
          ->where([
            'id' => $u->id
          ])
          ->findOne();
        
        $this->assertEquals(
          $u->name,
          $r->name
        );
      }

      public function testSaveInsertWithoutPrimaryKey() {
        $u = new User();
        $u->name = 'Test 3';
        $u->save();

        $r = (new Orm())
          ->from('user')
          ->where([
            'name' => $u->name
          ])
          ->findOne();
        
        $this->assertEquals(
          $u->name,
          $r->name
        );
      }

      public function testDelete() {
        $r = (new Orm())->from('user')->find();
        $this->assertCount(2, $r);

        $r = (new Orm())
          ->from('user')
          ->where([
            'id' => 1
          ])
          ->remove();

        $r = (new Orm())
          ->from('user')
          ->where([
            'id' => 1
          ])
          ->findOne();
        $this->assertFalse($r);

        $r = (new Orm())->from('user')->find();
        $this->assertCount(1, $r);
      }
  }